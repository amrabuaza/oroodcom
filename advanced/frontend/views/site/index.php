<?php

use backend\models\Category;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use common\helper\Constants;

/* @var $this yii\web\View */
/* @return mixed
 * @var $dataProvider yii\data\ActiveDataProvider
 */


$this->title = 'Oroodcom';
?>

<div class="container">

    <div class="form-group">
        <?=Html::submitButton(Yii::t(Constants::APP, 'site.index.search'), ['value' => Url::to(['site/serach-item']), 'class' => 'serachBtn btn btn-primary'])?>
    </div>

    <?php
    Modal::begin([
        'header' => '<h4>' . Yii::t(Constants::APP, 'site.index.search') . '</h4>',
        'id' => 'myModal',
        'size' => 'modal-sm',
    ]);

    echo "<div id='myModalContent'></div>";

    Modal::end();

    ?>

    <div class="site-wrapper">

        <div class="grid">

            <div id="shopify-section-sidebar" class="shopify-section">
                <div data-section-id="sidebar" data-section-type="sidebar-section">
                    <nav class="grid__item small--text-center medium-up--one-fifth" role="navigation">
                        <hr class="hr--small medium-up--hide">
                        <div id="SiteNav" class="site-nav" role="menu" style="">
                            <ul class="list--nav">
                                <?php
                                $added = [];
                                $categories = Category::find()->all();
                                foreach ($categories as $category) {
                                    $name = $category->name;
                                    if (in_array($name, $added)) {
                                        ?>
                                        <li class="site-nav__item site-nav--active">
                                            <a href="/oroodcom/advanced/frontend/web/site/category-items?id=<?=$category->id?>"
                                               class="site-nav__link" aria-current="page"><?=$name?></a>
                                        </li>
                                    <?php } else {
                                        $added[] = $name;
                                    }
                                } ?>
                            </ul>
                            <ul class="list--inline social-links">
                            </ul>
                        </div>
                        <hr class="medium-up--hide hr--small hr--border-bottom">
                    </nav>
                </div>
            </div>

            <main class="main-content grid__item medium-up--four-fifths" id="MainContent" role="main">


                <div class="index-sections">
                    <!-- BEGIN content_for_index -->
                    <div id="shopify-section-featured-products" class="shopify-section">
                        <hr class="medium-up--hide hr--clear hr--small">
                        <div class="featured-products">
                            <h2 class="small--text-center"><?=Yii::t(Constants::APP, 'site.index.items')?></h2>
                            <div class="grid grid--uniform" role="list">

                                <div class="grid__item">
                                    <div class="grid grid--uniform">
                                        <?php
                                        foreach ($dataProvider as $obj) {
                                            $shop = $obj->shop;

                                            ?>
                                            <div class="grid__item product medium-up--one-third small--one-half">
                                                <div class=" text-center">
                                                    <img class="item-pic"
                                                         src="/oroodcom/advanced/frontend/web/uploads/<?=$obj->picture?>"
                                                         class="img-fluid"
                                                         alt="">
                                                    <div class="product__title"><a
                                                                href="/admin/products"><?=$obj->name?></a></div>
                                                    <div class="product__price"><strike
                                                                style="color:red">JD<?=$obj->old_price . " "?></strike>JD<?php echo $obj->price ?>
                                                    </div>
                                                </div>
                                                <div class="social-sharing__link"><?=$obj->description?></div>
                                                <br/>
                                                <div class="text-right"><a
                                                            href="/oroodcom/advanced/frontend/web/shop/info?id=<?=$shop->id?>"> <?=$shop->name?></a>
                                                </div>

                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>
                </div>
            </main>
        </div>
        <hr>


    </div>


</div>
