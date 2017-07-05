<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = '产品管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index box box-info">

    <div class="box-header">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a(Yii::t('app', '创建产品'), ['create'], ['class' => 'btn btn-success btn-xs']) ?>
    </p>

<?php Pjax::begin(); ?>
        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'category_id',
                'label' => '分类',
                'value' => 'categoryName.name',
                'filter' => Html::activeDropDownList($searchModel, 'category_id',ArrayHelper::map($category,'id','name'),['prompt'=>'全部'] )
            ],
            'name',
            'list_img',
            'info',
            // 'content:ntext',
            'created_at:date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
</div>
