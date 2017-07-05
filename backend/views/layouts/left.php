<aside class=" main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => '主菜单', 'options' => ['class' => 'header']],

                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],

                    [
                        'label' => '订单管理',
                        'icon' => 'fa fa-share',
                        'visible'=> isset($permissions['orders']) ? 1 : 0,
                        'url' => '#',
                        'active' => Yii::$app->controller->module->id == 'orders',
                        'items' => [
                            ['label' => '提交记录', 'icon' => 'fa fa-dot-circle-o','active' => Yii::$app->controller->id == 'orders', 'visible'=> isset($permissions['orders']['orders']['index']) ? 1 : 0, 'url' => ['/orders/orders/index','status'=>0]],
                            ['label' => '退款记录', 'icon' => 'fa fa-dot-circle-o','active' => Yii::$app->controller->id == 'orders', 'visible'=> isset($permissions['orders']['orders']['index']) ? 1 : 0, 'url' => ['/orders/orders/index','status'=>3]],
                        ],
                    ],

                    [
                        'label' => '用户管理',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'active' => Yii::$app->controller->module->id == 'users',
                        'visible'=> isset($permissions['users']) ? 1 : 0,
                        'items' => [
                            ['label' => '员工列表', 'icon' => 'fa fa-dot-circle-o','active' => Yii::$app->controller->id == 'users'&&Yii::$app->controller->action->id == 'index','visible'=> isset($permissions['users']['users']['index']) ? 1 : 0, 'url' => ['/users/users/index']],
                            ['label' => '客户列表', 'icon' => 'fa fa-dot-circle-o','active' => Yii::$app->controller->id == 'users'&&Yii::$app->controller->action->id == 'patriarch-index','visible'=> isset($permissions['users']['users']['patriarch-index']) ? 1 : 0, 'url' => ['/users/users/patriarch-index']],

                            ['label' => '用户组', 'icon' => 'fa fa-dot-circle-o','active' => Yii::$app->controller->id == 'role','visible'=> isset($permissions['role']['role']['index']) ? 1 : 0, 'url' => ['/role/role/index']],
                        ],
                    ],

                ],
            ]
        ) ?>

    </section>

</aside>
