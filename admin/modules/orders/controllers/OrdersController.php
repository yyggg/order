<?php

namespace app\modules\orders\controllers;


use app\modules\staff\models\Staff;
use app\modules\staff\models\StaffSearch;
use backend\modules\service\models\ServiceCategory;
use Yii;
use app\modules\orders\models\Orders;
use app\modules\orders\models\OrdersSearch;
use app\components\CommonController;
use yii\web\NotFoundHttpException;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends CommonController
{

    /**
     * Lists all Orders models.
     * @return mixed
     */
    //托服订单列表
    public function actionIndex($status = 0)
    {
        $searchModel = new OrdersSearch();
        $queryParams = Yii::$app->request->queryParams;
        $dataProvider = $searchModel->search($queryParams);

        if (isset($queryParams['OrdersSearch']['status'])) $status = $queryParams['OrdersSearch']['status'];


        /*if($status == 0)
            $dataProvider->query->andFilterWhere(['<','status',4]);
        else
            $dataProvider->query->andFilterWhere(['status'=>$status]);*/

        if($status == 2) //退款中
        {
            $dataProvider->query->andFilterWhere(['<','status',4]);
            $dataProvider->query->andFilterWhere(['>','status',1]);
        }
        elseif ($status == 0)
        {
            $dataProvider->query->andFilterWhere(['<','status',4]);
        }
        else
        {
            $dataProvider->query->andFilterWhere(['status'=>$status]);
        }



        $dataProvider->query->andFilterWhere(['userid'=>Yii::$app->user->identity->id]);

        $amount = 0;
        $data = $dataProvider->models;
        foreach ($data as $v)
        {
            $amount += $v->amount;
        }

        return $this->render('/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'status' => $status,
            'amount' => $amount,
        ]);
    }


    /**
     * Displays a single Orders model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('/view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Orders();
        $data = Yii::$app->request->post();

        if ($model->load($data)) {
            $model->userid = Yii::$app->user->identity->id;
            if($model->save())
            {
                Yii::$app->session->setFlash('success', ['delay'=>3000,'message'=>'保存成功！']);
                return $this->redirect(['index','status' => 0]);
            }

            Yii::$app->session->setFlash('error', ['delay'=>3000,'message'=>'保存失败！']);

        }
        return $this->render('/create', [
            'model' => $model,
        ]);

    }


    /**
     * 申请退款
     * @param integer $id
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $data = Yii::$app->request->post();
        if($data)
        {
            $model->refund_remark = $data['Orders']['refund_remark'];
            $model->status = 2;
            $model->save();
            return $this->redirect(['index','status'=>0]);
        }

        return $this->render('/update',['model' => $model]);
    }
    public function actionRemarkSelf($id)
    {
        $model = $this->findModel($id);
        $data = Yii::$app->request->post();
        if($data)
        {
            $model->remark_self = $data['Orders']['remark_self'];
            $model->save(false);
            return $this->redirect(['index','status'=>0]);
        }

        return $this->render('/admin-remark',['model' => $model]);
    }
    /**
     * 确认退款
     * @param integer $id
     */
    public function actionRealRefund($id)
    {
        $model = $this->findModel($id);
        $data = Yii::$app->request->post();
        if($data)
        {
            $model->wuliu_no = $data['Orders']['wuliu_no'];
            $model->status = 3;
            $model->save();
            return $this->redirect(['index','status'=>0]);
        }

        return $this->render('/real-refund',['model' => $model]);
    }

    /**
     * Deletes an existing Orders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
