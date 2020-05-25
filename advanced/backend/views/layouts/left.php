<?php

use backend\models\User;

$user = User::findOne(Yii::$app->user->id);
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?=$directoryAsset?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?=$user->username?></p>
            </div>
        </div>

        <?=dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => [
                    ['label' => 'Oroodcom Dashbord', 'options' => ['class' => 'header']],
                    ['label' => 'Users', 'icon' => 'users', 'url' => ['/user']],
                    ['label' => 'Shops', 'icon' => 'shopping-cart', 'url' => ['/shop'],],
                    ['label' => 'Pending Shops', 'icon' => 'shopping-cart', 'url' => ['/shop/index?status=inactive'],],
                    ['label' => 'Categories', 'icon' => 'list', 'url' => ['/category/index'],],
                    ['label' => 'Pending category names', 'icon' => 'list', 'url' => ['/pending-default-category-name'],],
                    ['label' => 'Items', 'icon' => 'list', 'url' => ['/item'],],
                ],
            ]
        )?>

    </section>

</aside>
