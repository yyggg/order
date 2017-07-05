<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Article */

$this->title = '更新产品: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '产品管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="product-update">

    <?= $this->render('_form', [
        'model' => $model,
        'categoryPath' => $categoryPath,
    ]) ?>

</div>
