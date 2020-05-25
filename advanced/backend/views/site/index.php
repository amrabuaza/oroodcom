<?php

/* @var $this yii\web\View */

$this->title = 'Oroodcom dashboard';

use backend\models\Item;
use backend\models\PendingDefaultCategoryName;
use backend\models\User;
use backend\models\Shop;

?>
<div class="site-index">

    <div class="body-content">
        <div class="container home-stats text-center">
            <div class="row width-90-perc">
                <div class="col-md-3 p-b-mobile">

                    <div class="stat st-users">
                        Total Users
                        <span><a href="user"><?= User::find()->count() ?></a> </span>
                    </div>
                </div>
                <div class="col-md-3 p-b-mobile">
                    <div class="stat st-shops">
                        Total Shops
                        <span><a href="shop"><?= Shop::find()->count() ?></a> </span>
                    </div>
                </div>
                <div class="col-md-3 p-b-mobile">
                    <div class="stat st-pending">
                        Pending Shops
                        <span><a href="shop/index?status=inactive"><?= Shop::find()->where(["status" => "inactive"])->count() ?></a> </span>
                    </div>
                </div>
                <div class="col-md-3 p-b-mobile">
                    <div class="stat st-items">
                        Total Pending category names
                        <span><a href="pending-default-category-name"><?= PendingDefaultCategoryName::find()->where(["status" => "inactive"])->count() ?></a></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="latest">

            <div class="container">
                <div class="row width-90-perc">
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="glyphicon glyphicon-user pic-user"></div>
                                Latest Registerd Users
                            </div>
                            <div class="panel-body">
                                <ul class="list-unstyled latest-users">
                                    <?php
                                    $array = User::find()->orderBy(["id" => SORT_DESC])->all();
                                    $c = 0;
                                    foreach ($array as $obj) {
                                        if ($c == 6)
                                            break;
                                        echo "<li>" . $obj->username . ' <div class="pull-right">
                                <a href="/oroodcom/advanced/backend/web/user/view?id=' . $obj->id . '"title="View" aria-label="View" data-pjax="0">
                                   
                                    <span class="glyphicon glyphicon-eye-open action"></span>
                                </a>
                                </div></li>'; ?>

                                        <?php
                                        $c++;
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="glyphicon glyphicon-glass pic-user"></div>
                                Latest Shops
                            </div>
                            <div class="panel-body">

                                <ul class="list-unstyled latest-users">
                                    <?php
                                    $array = Shop::find()->orderBy(["id" => SORT_DESC])->all();
                                    $c = 0;
                                    foreach ($array as $obj) {
                                        if ($c == 6)
                                            break;
                                        echo "<li>" . $obj->name . ' <div class="pull-right">
                                <a href="/oroodcom/advanced/backend/web/shop/view?id=' . $obj->id . '"title="View" aria-label="View" data-pjax="0">
                                   
                                    <span class="glyphicon glyphicon-eye-open action"></span>
                                </a>
                                </div></li>'; ?>

                                        <?php
                                        $c++;
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div><!-- end latest  -->

    </div>


</div>
