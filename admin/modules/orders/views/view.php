<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $model app\modules\guarantee\models\Guarantee */

$this->title = '订单详细';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guarantee-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'site',
            'address',
            'refund_address',
            'refund_remark',
            'size',
            'amount',
            'number',
            'order_no',
            'wuliu_no',
            'order_wuliu_no',
            'shop_name',
            'remark_self',
            'admin_remark',
            'remark',
            'created_at:date',
        ],
        'template' => '<tr><th class="col-md-2">{label}</th><td>{value}</td></tr>',
    ]) ?>

</div>