<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\presscentre\models\PresscentreSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '订单');
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="box box-info guarantee-index">
        <div class="box-header">
    <?php  echo $this->render('_search', ['model' => $searchModel, 'status' => $status]); ?>

    <p>
        <?php if(Yii::$app->user->can('orders/orders/create')) echo Html::a(Yii::t('app', 'Create Orders'), ['create'], ['class' => 'btn btn-success btn-xs']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'headerOptions'=> ['width'=> '50'],
            ],
            'site',
            'address',
            'refund_address',
            [
                'attribute' => 'size',
                'headerOptions'=> ['width'=> '70'],
            ],
            'order_no',
            'order_wuliu_no',
            [
                'attribute' => 'wuliu_no',
                'visible' =>  $status == 3 ? true : false,
                'headerOptions'=> ['width'=> '80'],
            ],
            [
                'attribute' => 'amount',
                'headerOptions'=> ['width'=> '55'],
            ],
            [
                'attribute' => 'number',
                'headerOptions'=> ['width'=> '50'],
            ],
            'shop_name',
            'created_at:date',

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'操作',
                'template' => '{update} {view}',
                'headerOptions'=> ['width'=> '155'],
                'buttons' => [
                    'update' => function ($url, $model) {
                        if($model->status < 2)
                        {
                            return Html::a('申请退款', $url);
                        }
                        if($model->status == 3 && !$model->wuliu_no)
                        {
                            return Html::a('确认退款', ['real-refund','id'=>$model->id]);
                        }
                        else
                        {
                            return '';
                        }
                    },
                    'view' => function($url){
                        return Html::a('详细', $url);
                    }
                ]
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>
        <div>
            订单总额：<?=$amount?>
        </div>
    </div>
