<?php

use common\helper\Constants;
use yii\helpers\Html;

/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = Yii::t(Constants::APP, 'site.view.my_shops');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="restaurant-index">

        <h1><?=Html::encode($this->title)?></h1>
        <p>
            <?=Html::a(Yii::t(Constants::APP, 'shop.add_shop'), ['create'], ['class' => 'btn btn-success'])?>
        </p>
        </br>
        <div class="row">
            <?php
            foreach ($dataProvider

            as $obj)
            { ?>
            <div class="col-lg-4 col-sm-6"
            ">
            <div class="card">
                <!--Card image-->
                <div class="view overlay">
                    <img class="shopCardPic img-fluid" src="/oroodcom/advanced/frontend/web/uploads/<?=$obj->picture?>"
                         alt="">
                </div>
                <div class="card-bodyhome">
                    <!--Card content-->
                    <div class="card-body">
                        <!--Title-->
                        <h4 class="card-title text-center"><?=$obj->name?>
                            <?php
                            if ($obj->status == "active") {

                                ?>
                                <img class="pl" src="/oroodcom/advanced/frontend/web/images/Bullet-green.png"/>
                            <?php } else {
                                ?>
                                <img class="pl" src="/oroodcom/advanced/frontend/web/images/Bullet-red.png"/>
                            <?php } ?>
                        </h4>
                        <!--Text-->
                        <ul class="list-group">
                            <div class="col-md-4">
                                <li class="list-group-item"><a
                                            href="/oroodcom/advanced/frontend/web/category/index?id=<?=$obj->id?>">Category</a>
                                </li>
                            </div>
                        </ul>

                        <div class="icons col-md-12 text-right" style="">
                            <div id="spaceup">
                                <a href="/oroodcom/advanced/frontend/web/shop/view?id=<?=$obj->id?>"
                                   title="View" aria-label="View" data-pjax="0">
                                    <span class="glyphicon glyphicon-eye-open action"></span>
                                </a>

                                <a href="/oroodcom/advanced/frontend/web/shop/<?=$obj->id?>" title="Update"
                                   aria-label="Update" data-pjax="0">
                                    <span class="glyphicon glyphicon-pencil action"></span>
                                </a>

                                <a href="/oroodcom/advanced/frontend/web/shop/delete?id=<?=$obj->id?>" title="Delete"
                                   aria-label="Delete" data-pjax="0"
                                   data-confirm="Are you sure you want to delete this item?" data-method="post">
                                    <span class="glyphicon glyphicon-trash action"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>

    </div>
</div>
</div>
