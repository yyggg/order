<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\modules\cfg\models\WebCfg */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="web-cfg-form box box-info">
    <p></p>

    <?php $form = ActiveForm::begin(['layout'=>'horizontal','options'=>['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => '字段唯一']) ?>

    <?= $form->field($model, 'value')->textInput(['maxlength' => true, 'placeholder' => '多个值用半角","隔开']) ?>

    <div class="box-footer">
        <a href="<?= Url::to(['index']);?>" class="col-md-offset-5 btn btn-info fa fa-reply"></a>
        <?= Html::submitButton('', ['class' => 'col-md-offset-1 btn btn-info fa fa-save']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
