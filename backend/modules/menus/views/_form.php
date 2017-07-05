<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\menus\models\Menus */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="box box-info">
	<div class="box-header with-border">
		<h3 class="box-title"><?= $this->title; ?></h3>
	</div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php $form = ActiveForm::begin([
				'options' => ['class'=>'form-horizontal'],
            	'fieldConfig' => [
            		'labelOptions' => ['class' => 'col-sm-2 control-label'],
            		'template' => "{label}\n<div class=\"col-sm-8\">{input}</div>\n<div class=\"col-sm-8\">{error}</div>", 
            	]
			]); ?>
			<div class="box-body">
			<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
		    <?= $form->field($model, 'parent')->textInput() ?>
		    <?= $form->field($model, 'route')->textInput(['maxlength' => true]) ?>
		    <?= $form->field($model, 'sort')->textInput() ?>
               
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="<?= Url::to(['menus/index']);?>" class="btn btn-info fa fa-reply"></a>
                <?= Html::submitButton('', ['class' => 'btn btn-info pull-right fa fa-save']) ?>
              </div>
              <!-- /.box-footer -->
            <?php ActiveForm::end(); ?>
</div>
          

</div>
