<?php

use msvdev\widgets\mappicker\MapInput;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Shop */

$this->title = $model->name;
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="shop-view">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
    <br/>
    <br/>

    <?= Html::img('/oroodcom/advanced/frontend/web/uploads/shops/'.$model->picture, ['class' => 'img-responsive shop-pic']);?>

    <br/>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'phone_number',
            'description',
            'open_at',
            'close_at',
            'rate',
        ],
    ]) ?>

    <?php
    echo \pigolab\locationpicker\LocationPickerWidget::widget([
        'key' => 'AIzaSyBaSSGZhnqDf3-jB7zJYXGiS5JCjTNL4U0',	// optional , Your can also put your google map api key
        'options' => [
            'style' => 'width: 100%; height: 400px', // map canvas width and height
        ] ,
        'clientOptions' => [
            'location' => [
                'latitude'  => $model->latitude ,
                'longitude' => $model->longitude,
            ],
            'radius'    => 300,
            'inputBinding' => [
                'latitudeInput'     => new JsExpression("$('#us2-lat')"),
                'longitudeInput'    => new JsExpression("$('#us2-lon')"),
                'radiusInput'       => new JsExpression("$('#us2-radius')"),
                'locationNameInput' => new JsExpression("$('#us2-address')")
            ]
        ]
    ]);
    ?>

</div>
