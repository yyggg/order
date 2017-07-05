<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\guarantee\models\Guarantee */

$this->title = Yii::t('app', 'Update Orders');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="mien-update">

    <div class="presscentre-form box box-info">
        <div class="box-header with-border">
            <h6 >订单信息</h6>
            商品网站：<?php echo $model->site;?>
            地址：<?php echo $model->address;?>
            尺码：<?php echo $model->size;?>
            订单号：<?php echo $model->order_no;?>
            支付金额：<?php echo $model->amount;?>
            购买数量：<?php echo $model->number;?>
            店铺名称：<?php echo $model->shop_name;?>
            买家留言：<?php echo $model->remark;?>
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


            <?= $form->field($model, 'admin_remark')->textarea() ?>

            <div class="box-footer">
                <a href="<?= Url::to(['index']);?>" class="col-md-offset-5 btn btn-info fa fa-reply"></a>
                <?= Html::submitButton('', ['class' => 'col-md-offset-1 btn btn-info fa fa-save']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>

    </div>

</div>