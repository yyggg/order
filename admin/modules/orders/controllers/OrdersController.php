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
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['status'=>$status]);
        return $this->render('/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }



    /**
     * Displays a single Orders model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = Orders::find()->joinWith('staff')->where([Orders::tableName().'.'.'id'=>$id])->one();
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

            if($model->save())
            {
                Yii::$app->session->setFlash('success', ['delay'=>3000,'message'=>'保存成功！']);
                return $this->redirect(['index']);
            }

            Yii::$app->session->setFlash('error', ['delay'=>3000,'message'=>'保存失败！']);

        }
        return $this->render('/create', [
            'model' => $model,
        ]);

    }


    /**
     * 发货
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $data = Yii::$app->request->post();
        if($data)
        {
            $model->admin_remark = $data['Orders']['admin_remark'];
            $model->status = 1;
            $model->save();
            return $this->redirect(['index']);
        }

        return $this->render('/update',['model' => $model]);
    }

    /**
     * 同意退款
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionRefund($id)
    {
        $model = $this->findModel($id);
        $data = Yii::$app->request->post();
        if($data)
        {
            $model->admin_remark = $data['Orders']['admin_remark'];
            $model->refund_address = $data['Orders']['refund_address'];
            $model->status = 3;
            $model->save();
            return $this->redirect(['index']);
        }

        return $this->render('/refund',['model' => $model]);

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
