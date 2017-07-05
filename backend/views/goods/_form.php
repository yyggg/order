<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use \kartik\file\FileInput;
/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="article-form box box-info">
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

    <div class="form-group">
        <div class="category">
            <label class="col-sm-2 control-label">产品分类</label>
            <select class="form-control" id="category"></select>
        </div>

    </div>
    <?= Html::hiddenInput('Goods[category_id]','', ['id' => 'category_id'])?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?=
    $form->field($model, 'list_img')->widget(FileInput::classname(), [
        'options' => [
            'accept' => 'image/*',
        ],
        'pluginOptions' =>[
            'showUpload' => false,
            'showRemove' => false,
            'showPreview' => false,
            'showCaption' => true,
            'allowedFileExtensions'=>['jpg','jpeg','png'],
        ],

    ]);
    ?>

    <?= $form->field($model, 'info')->textarea(['rows' => 2]) ?>
    <?= $form->field($model, 'content')->widget('kucha\ueditor\UEditor',[]) ?>

    <div class="box-footer">
        <a href="<?= Url::to(['article/index']);?>" class="btn btn-info fa fa-reply"></a>
        <?= Html::submitButton('', ['class' => 'btn btn-info pull-right fa fa-save']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
    </div>
<?php $this->beginBlock('js_end') ?>
    var categoryPath = <?= json_encode(array_keys(isset($categoryPath) ? $categoryPath : []))?>;
    var opts = {
    ajax: '?r=/product/product-category/get-node',
    select: '#category',
    selClass: 'form-control',
    head: '--请选择--',
    defVal: categoryPath

    };
    var linkageSel = new LinkageSel(opts);
    $('form button[type=submit]').on('click', function(){
    $('#category_id').val(linkageSel.getSelectedValue());
    });
<?php $this->endBlock(); ?>

<?php $this->registerJs($this->blocks['js_end'],\yii\web\View::POS_LOAD);//将编写的js代码注册到页面底部 ?>