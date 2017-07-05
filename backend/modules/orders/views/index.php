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
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php if(Yii::$app->user->can('orders/orders/create')) echo Html::a(Yii::t('app', 'Create Orders'), ['create'], ['class' => 'btn btn-success btn-xs']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'headerOptions'=> ['width'=> '80'],
            ],
            'site',
            'address',
            'refund_address',
            'size',
            'order_no',
            'amount',
            [
                'attribute' => 'number',
                'headerOptions'=> ['width'=> '80'],
            ],
            'shop_name',
            'remark',
            'created_at:date',

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'操作',
                'template' => '{update}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        if($model->status < 2)
                        {
                            return Html::a('申请退款', $url);
                        }
                        else
                        {
                            return '';
                        }
                    }
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>
    </div>