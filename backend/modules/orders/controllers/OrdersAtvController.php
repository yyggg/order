<?php

namespace app\modules\orders\controllers;


use app\modules\student\models\Patriarch;
use Yii;
use app\modules\orders\models\OrdersAtv;
use app\modules\orders\models\OrdersAtvSearch;
use app\components\CommonController;
use yii\web\NotFoundHttpException;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersAtvController extends CommonController
{
    //活动订单列表
    public function actionIndex()
    {
        $searchModel = new OrdersAtvSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['type'=>1]);
        //限制跨校区操作
        $dataProvider = $this->schoolRule($dataProvider);

        return $this->render('/atv-index', [
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
        return $this->render('/atv-view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new OrdersAtv();
        $data = Yii::$app->request->post();

        if ($model->load($data)) {
            //开始时间不能小于结束时间
            if(strtotime($model->stime) > strtotime($model->etime))
            {
                Yii::$app->session->setFlash('error', ['delay'=>3000,'message'=>'保存失败,服务开始时间必须小于结束时间']);
                return $this->render('/atv-create', [
                    'model' => $model,
                ]);
            }

            $tmp = Orders::find()
                ->where(['student_id'=>$model->student_id])
                ->andWhere(['product_id'=>$model->product_id])
                ->andWhere(['type'=>1])
                ->orderBy('id')
                ->one();
            //如果同一个服务订单的开始时间小于最近一个订单的结束时间，则不允许创建
            if($tmp)
            {
                if(strtotime($model->stime) < $tmp->etime)
                {
                    Yii::$app->session->setFlash('error', ['delay'=>3000,'message'=>'保存失败,服务开始时间必须大于最近订单服务结束时间']);
                    return $this->render('/atv-create', [
                        'model' => $model,
                    ]);
                }
            }

            $model->principal = Yii::$app->user->identity->name;
            $model->category_id = 0;
            $model->type = 1;
            $model->stime = strtotime($data['OrdersAtv']['stime']);
            $model->etime = strtotime($data['OrdersAtv']['etime']);
            //查询是否已存在家长
            $patriarch = Patriarch::find()->where(['phone'=>$model->phone])->one();
            if($patriarch) $model->patriarch_name = $patriarch->name;
            if($model->save())
            {
                //如果家长不存在则添加
                if(!$patriarch)
                {
                    $patriarch = new Patriarch();
                    $patriarch->name = $model->patriarch_name;
                    $patriarch->phone = $model->phone;
                    $patriarch->save(false);
                }

                Yii::$app->session->setFlash('success', ['delay'=>3000,'message'=>'保存成功！']);
                return $this->redirect(['index']);
            }
            //print_r($model->getErrors());die;
            Yii::$app->session->setFlash('error', ['delay'=>3000,'message'=>'保存失败！']);
        }
        return $this->render('/atv-create', [
            'model' => $model,
        ]);

    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->stime = date('Y-m-d', $model->stime);
        $model->etime = date('Y-m-d', $model->etime);
        $data = Yii::$app->request->post();

        if ($model->load($data)) {
            $model->principal = Yii::$app->user->identityname;
            $model->stime = strtotime($data['OrdersAtv']['stime']);
            $model->etime = strtotime($data['OrdersAtv']['etime']);
            //print_r($data);
            //print_r($model);die;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('/atv-update', [
                'model' => $model,
            ]);
        }
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
        if (($model = OrdersAtv::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
