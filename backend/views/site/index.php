<?php
    use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = '和家托辅教育管理平台';
?>
<div class="site-index">
    <div class="row">
        <div>
            <?php if(Yii::$app->user->can('student/student/create')):?>
                <a href="<?= Url::to(['/student/student/create'])?>" class="btn btn-lg btn-primary">新增学生</a>
            <?php endif;?>
            <?php if(Yii::$app->user->can('orders/orders/create')):?>
                <a href="<?= Url::to(['/orders/orders/create'])?>" class="btn btn-lg btn-primary">新增托辅订单</a>
            <?php endif;?>
        </div>
        <div>
            <?php if(Yii::$app->user->can('weekly/weekly/create')):?>
                <a href="<?= Url::to(['/weekly/weekly/create'])?>" class="btn btn-lg btn-primary">新增学生周报</a>
            <?php endif;?>
            <?php if(Yii::$app->user->can('weekly/president-check/index')):?>
                <a href="<?= Url::to(['/weekly/president-check/index'])?>" class="btn btn-lg btn-primary">周报审核(校长)</a>
            <?php endif;?>
        </div>
        <div>
            <?php if(Yii::$app->user->can('weekly/weekly-push/create')):?>
                <a href="<?= Url::to(['/weekly/weekly-push/create'])?>" class="btn btn-lg btn-primary">周报推送</a>
            <?php endif;?>
            <?php if(Yii::$app->user->can('weekly/customer-check/index')):?>
                <a href="<?= Url::to(['/weekly/customer-check/index'])?>" class="btn btn-lg btn-primary">周报审核(客服)</a>
            <?php endif;?>
        </div>
    </div>


</div>
