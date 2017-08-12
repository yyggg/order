<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\guarantee\models\GuaranteeSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    .form-group {
        float: left;
    }
    .summary {
        left: 100px;
        width: 200px;
    }
</style>
<div class="guarantee-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "<div class='col-xs-6 col-sm-3 text-right'>{label}</div><div class='col-xs-7 col-sm-5'>{input}</div>
            <div class='col-xs-12 col-xs-offset-3 col-sm-3 col-sm-offset-0'>{error}</div>",
        ]
    ]); ?>

    <?= $form->field($model, 'status')->textInput(['value' => $status,'type' => 'hidden'])->label('') ?>
    <?= $form->field($model, 'stime')->label('开始时间') ?>

    <?= $form->field($model, 'etime')->label('结束时间') ?>


    <?php // echo $form->field($model, 'buyer_name') ?>

    <?php // echo $form->field($model, 'buy_by') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'street') ?>

    <?php // echo $form->field($model, 'complete_at') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', '搜索'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
