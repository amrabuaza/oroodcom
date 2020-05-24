<?php

use common\helper\Constants;
use kartik\file\FileInput;
use kartik\time\TimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Shop */
/* @var $form yii\widgets\ActiveForm */
/* @var $longitude string */
/* @var $latitude string */
?>

<div class="shop-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-6"><?=$form->field($model, 'name')->textInput(['maxlength' => true])?></div>
        <div class="col-lg-6"><?=$form->field($model, 'name_ar')->textInput(['maxlength' => true])?></div>
    </div>

    <div class="row">
        <div class="col-lg-6">    <?=$form->field($model, 'description')->textarea(['maxlength' => true])?></div>
        <div class="col-lg-6"><?=$form->field($model, 'description_ar')->textarea(['maxlength' => true])?></div>
    </div>

    <?php
    $initialPreview = [];

    if (!$model->isNewRecord) {
        $pathImg = '../uploads/shops/' . $model->picture;
        $initialPreview[] = Html::img($pathImg, ['class' => 'upload-image']);
    } ?>
    <div class="shop-pic">
        <?=$form->field($model, "upload_image")->label(false)->widget(FileInput::classname(), [
            'options' => [
                'multiple' => false,
                'accept' => 'image/*',
                'class' => 'optionvalue-img'
            ],
            'pluginOptions' => [
                'previewFileType' => 'image',
                'showCaption' => false,
                'showUpload' => false,
                'browseClass' => 'btn btn-default btn-sm',
                'browseLabel' => Yii::t(Constants::APP, "shop.fields.pick_image"),
                'browseIcon' => '<i class="glyphicon glyphicon-picture"></i>',
                'removeClass' => 'btn btn-danger btn-sm',
                'removeLabel' => Yii::t(Constants::APP, "buttons.delete"),
                'removeIcon' => '<i class="fa fa-trash"></i>',
                'previewSettings' => [
                    'image' => ['width' => '100px', 'height' => 'auto']
                ],
                'initialPreview' => $initialPreview,
            ]
        ])->label(Yii::t(Constants::APP, "shop.fields.picture"))?>

    </div>

    <?=$form->field($model, 'address')
        ->widget(\msvdev\widgets\mappicker\MapInput::className(),
            [
                'mapCenter' => [$latitude, $longitude],
                'mapZoom' => 15,
                'apiKey' => 'AIzaSyBaSSGZhnqDf3-jB7zJYXGiS5JCjTNL4U0',
            ])->label(false);?>

    <?=$form->field($model, 'phone_number')->textInput()?>

    <div class="flex">
        <div class="shop-time">
            <label class="control-label"><?=Yii::t(Constants::APP, "shop.fields.open_at")?></label>
            <?=TimePicker::widget(['model' => $model, 'attribute' => 'open_at']);?>
        </div>
        <div class="shop-time">
            <label class="control-label"><?=Yii::t(Constants::APP, "shop.fields.close_at")?></label>
            <?=TimePicker::widget(['model' => $model, 'attribute' => 'close_at']);?>
        </div>
    </div>

    <div class="form-group">
        <?=Html::submitButton(Yii::t(Constants::APP, "buttons.save"), ['class' => 'btn btn-success'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
