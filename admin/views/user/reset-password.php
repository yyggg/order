<?php
    use yii\widgets\ActiveForm;
    $this->title = '密码修改';
?>
<div class="col-md-offset-3 col-md-6">
    <!-- Horizontal Form -->
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"><?=$model->name;?></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
            <?php $form = ActiveForm::begin([
                'options' => ['class'=>'form-horizontal'],
                'fieldConfig' => [
                    'labelOptions' => ['class' => 'col-sm-2 control-label'],
                    'template' => "{label}\n<div class=\"col-sm-9\">{input}</div>\n<div class=\"col-sm-9\">{error}</div>",
                ]
            ]);?>
            <div class="box-body">
                <?= $form->field($model, 'password')?>
                <?= $form->field($model, 'passwordok')?>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="button" class="btn btn-default">取消</button>
                <button type="submit" class="btn btn-info pull-right">确定</button>
            </div>
            <!-- /.box-footer -->
        <?php $form->end();?>
    </div>
    <!-- /.box -->
</div>