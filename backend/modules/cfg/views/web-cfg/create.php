<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\cfg\models\WebCfg */

$this->title = Yii::t('app', 'Create Web Cfg');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Web Cfgs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="web-cfg-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
