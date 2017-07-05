<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\menus\models\Menus */

$this->title = Yii::t('app', '修改菜单', [
    'modelClass' => 'Menus',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '菜单列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', '修改菜单');
?>
<div class="menus-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
