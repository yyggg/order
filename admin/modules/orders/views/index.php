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


    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'headerOptions'=> ['width'=> '55'],
            ],
            'site',
            'address',
            'size',
            'order_no',
            'order_wuliu_no',
            'wuliu_no',
            'amount',
            [
                'attribute' => 'number',
                'headerOptions'=> ['width'=> '50'],
            ],
            'shop_name',
            //'admin_remark',
            'created_at:date',

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'操作',
                'headerOptions'=> ['width'=> '95'],
                'template' => '{update} {view}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        if($model->status == 0)
                        {
                            return Html::a('发货', ['update','id'=>$model->id]);
                        }
                        elseif ($model->status == 2)
                        {
                            return Html::a('同意退款', ['refund','id'=>$model->id]);
                        }
                        elseif ($model->status == 3)
                        {
                            return Html::a('确认退款', ['real-refund','id'=>$model->id]);
                        }
                        else
                        {
                            return '';
                        }
                    }
                    ,
                    'view' => function($url){
                        return Html::a('详细', $url);
                    }
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>
        <div>
            订单总额：<?=$amount?>
        </div>
    </div>