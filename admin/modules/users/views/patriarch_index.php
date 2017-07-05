<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\users\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '用户管理');
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = '客户列表';
?>
<div class="box box-info">
    <div class="box-header">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <p>
            <?php if(Yii::$app->user->can('users/users/create')) echo Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success btn-xs']) ?>
        </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',
            'username',
            'name',
            //'phone',
            //'email',
            // 'auth_key',
            // 'password_hash',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($model){
                    if($model->status == 'active')
                        return '<span style="color: #00A000">有效</span>';
                    else
                        return '<span style="color: #ccc">无效</span>';
                },
            ],
             'created_at:date',
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'headerOptions'=> ['width'=> '70'],
                'template' => '{view} &nbsp; {update} &nbsp; {delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return  Yii::$app->user->can('users/users/view') ?
                            Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url):
                            '';
                    },
                    'update' => function ($url, $model) {
                        return  Yii::$app->user->can('users/users/update') ?
                            Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url):
                            '';
                    },
                    'delete' => function ($url, $model) {
                        return  Yii::$app->user->can('users/users/delete') ?
                            Html::a('<span style="color: red" class="glyphicon glyphicon-ban-circle"></span>', $url, [
                                'data' => [
                                    'confirm' => Yii::t('app', '您确定要禁用或启用此用户吗?'),
                                    'method' => 'post',
                                ],
                                'title' => '禁用/启用',
                            ]):
                            '';
                    },
                ],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
</div>
