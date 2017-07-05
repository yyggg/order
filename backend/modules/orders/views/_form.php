<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\guarantee\models\Guarantee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="presscentre-form box box-info">
    <div class="box-header with-border">
        <h5 class="box-title"><?= $this->title; ?></h5>
    </div>
    <p></p>

    <div class="box-body">

        <?php $form = ActiveForm::begin([
            'options' => ['class'=>'form-horizontal','enctype'=>'multipart/form-data','id'=>'order-create'],
            'validateOnBlur' => false,
            'fieldConfig' => [
                'labelOptions' => ['class' => 'col-sm-2 control-label'],
                'template' => "{label}\n<div class=\"col-sm-8\">{input}</div>\n<div class=\"col-sm-8\">{error}</div>",
            ]
        ]); ?>

        <?= $form->field($model, 'site')->textInput() ?>
        <?= $form->field($model, 'address')->textInput() ?>
        <?= $form->field($model, 'size')->textInput() ?>
        <?= $form->field($model, 'order_no')->textInput() ?>
        <?= $form->field($model, 'amount')->textInput() ?>
        <?= $form->field($model, 'number')->textInput() ?>
        <?= $form->field($model, 'shop_name')->textInput() ?>

        <?= $form->field($model, 'remark')->textarea() ?>

        <div class="box-footer">
            <a href="<?= Url::to(['index']);?>" class="col-md-offset-5 btn btn-info fa fa-reply"></a>
            <?= Html::submitButton('', ['class' => 'col-md-offset-1 btn btn-info fa fa-save']) ?>
        </div>

    <?php ActiveForm::end(); ?>
    </div>

</div>

