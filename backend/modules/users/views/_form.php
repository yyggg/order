<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\modules\users\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form box box-info"">

<div class="box-header with-border">
    <h5 class="box-title"><?= $this->title; ?></h5>
</div>
<p></p>

<div class="box-body">

    <?php $form = ActiveForm::begin([
        'options' => ['class'=>'form-horizontal','enctype'=>'multipart/form-data'],
        'fieldConfig' => [
            'labelOptions' => ['class' => 'col-sm-2 control-label'],
            'template' => "{label}\n<div class=\"col-sm-8\">{input}</div>\n<div class=\"col-sm-8\">{error}</div>",
        ]
    ]); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true,'placeholder'=>'输入登录账号']) ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true,'placeholder'=>'输入您的姓名']) ?>

    <?= $form->field($model, 'password')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'role')->dropDownList(
        \yii\helpers\ArrayHelper::map(Yii::$app->getAuthManager()->getRoles(), 'name', 'description'),
        ['prompt'=>'']
    ) ?>


    <div class="box-footer">
        <a href="<?= Url::to(['index']);?>" class="col-md-offset-5 btn btn-info fa fa-reply"></a>
        <?= Html::submitButton('', ['class' => 'col-md-offset-1 btn btn-info fa fa-save']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
