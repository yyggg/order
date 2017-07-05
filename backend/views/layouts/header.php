<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">OA</span><span class="logo-lg">订单系统</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <!-- Messages: style can be found in dropdown.less-->


                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img style="background: #fff;" src="backend/web/images/logo.png" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"><?php if(!Yii::$app->user->isGuest) echo Yii::$app->user->identity->name;?></span>
                    </a>
                    <ul class="dropdown-menu">

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <?php if(Yii::$app->user->identity->type == 'staff'):;?>
                                    <a href="<?=Url::to(['/staff/staff/view','id'=>Yii::$app->user->identity->id,'userid'=>Yii::$app->user->identity->id])?>" class="btn btn-default btn-flat">用户信息</a>
                                <?php else:?>
                                    <a href="<?=Url::to(['/users/users/view','id'=>Yii::$app->user->identity->id])?>" class="btn btn-default btn-flat">用户信息</a>
                                <?php endif;?>
                            </div>
                            <div class="pull-left">
                                <a href="<?=Url::to(['/user/reset-password','id'=>Yii::$app->user->identity->id])?>" class="btn btn-default btn-flat">修改密码</a>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    '安全退出',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>


            </ul>
        </div>
    </nav>
</header>
