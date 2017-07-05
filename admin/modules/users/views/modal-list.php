<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\users\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="box box-info">
    <div class="box-header">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?php Pjax::begin(['id'=>'user-pjax']); ?>    <?= GridView::widget([
        'id' => 'user-grid-view',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'nickname',
            'city',
            'province',
            'phone',
            //'website',
            // 'auth_key',
            // 'password_hash',
             //'status',
             'created_at:date',
            // 'updated_at',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{select}',
                'header' => '操作',
                'buttons' => [
                    'select' => function ($url,$model, $key) {
                        return Html::a('选择', 'javascript:;', [
                            'title'=> '选择',
                            'onclick'=>"$('#userid').val($model->id);$('#username').val('$model->username');",
                            'data-dismiss'=> 'modal'
                        ] );
                    },
                ],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
</div>
