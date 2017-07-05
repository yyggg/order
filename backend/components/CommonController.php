<?php
namespace app\components;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\modules\staff\models\Staff;

class CommonController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['POST'],
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    //路由过滤
    public function beforeAction($action) {
        if(Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);
        }
        $actionID = Yii::$app->controller->action->id;
        $route = \Yii::$app->requestedRoute ? \Yii::$app->requestedRoute : \Yii::$app->defaultRoute . '/index';
        if(Yii::$app->user->can($route) || Yii::$app->request->isAjax || $actionID=='upload')
        {
            return true;
        }
        die('<div style="color:red; padding-top:50px;text-align:center;">您没有权限执行此操作</div>');
    }

    //限制跨校区操作
    public function schoolRule($dataProvider,$tablePrefix='')
    {
        if(Yii::$app->user->identity->role == 'principal' || Yii::$app->user->identity->role == 'teacher') {
            $staff = Staff::find()->select(['id','category_id'])->where(['userid'=>Yii::$app->user->identity->id])->one();
            if($staff) $dataProvider->query->andWhere([$tablePrefix.'category_id'=>$staff->category_id]);
        }
        return $dataProvider;
    }

}