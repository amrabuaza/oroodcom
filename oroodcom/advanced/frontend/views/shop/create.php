<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Shop */

$this->title = 'Create Shop';
$this->params['breadcrumbs'][] = ['label' => 'Shops', 'url' => ['index']];
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
