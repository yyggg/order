<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\users\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cfg');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-info">
    <div class="box-header">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <p>
            <?php if(Yii::$app->user->can('cfg/web-cfg/create')) echo Html::a(Yii::t('app', 'Create Web Cfg'), ['create'], ['class' => 'btn btn-success btn-xs']) ?>
        </p>
        <?php Pjax::begin(); ?>    <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'name',
                'value',

                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => '操作',
                    'template' => '{view} {update} {delete}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return  Yii::$app->user->can('cfg/web-cfg/view') ?
                                Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url):
                                '';
                        },
                        'update' => function ($url, $model) {
                            return  Yii::$app->user->can('cfg/web-cfg/update') ?
                                Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url):
                                '';
                        },
                        'delete' => function ($url, $model) {
                            return  Yii::$app->user->can('cfg/web-cfg/delete') ?
                                Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                    'data' => [
                                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                        'method' => 'post',
                                    ],
                                ]):
                                '';
                        },
                    ],
                ],
            ],
        ]); ?>
        <?php Pjax::end(); ?></div>
</div>
