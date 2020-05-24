<?php

use common\helper\Constants;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Shop */
/* @var $longitude string */
/* @var $latitude string */

$this->title = Yii::t(Constants::APP, 'shop.add_shop');
$this->params['breadcrumbs'][] = ['label' => Yii::t(Constants::APP, 'site.view.my_shops'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'longitude' =>$longitude,
        'latitude'=>$latitude,
    ]) ?>

</div>
