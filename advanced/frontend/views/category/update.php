<?php

use common\helper\Constants;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Category */
/* @var $shop backend\models\Shop */

$this->title = Yii::t(Constants::APP, 'category.update_btn');
$this->params['breadcrumbs'][] = ['label' => Yii::t(Constants::APP, 'site.view.my_shops'), 'url' => ['shop/index']];
$this->params['breadcrumbs'][] = ['label' => $shop->name, 'url' => ['shop/view?id=' . $shop->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t(Constants::APP, 'category.title'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-update">

    <h1><?=Html::encode($this->title)?></h1>

    <?=$this->render('_form', [
        'model' => $model
    ])?>

</div>
