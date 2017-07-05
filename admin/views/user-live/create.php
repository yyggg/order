<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UserLive */

$this->title = 'Create User Live';
$this->params['breadcrumbs'][] = ['label' => 'User Lives', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-live-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
