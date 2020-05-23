<?php

use kartik\file\FileInput;
use yii\bootstrap\Dropdown;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Shop */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="shop-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php
    $initialPreview = [];

    if (!$model->isNewRecord) {
        $pathImg = '../uploads/' . $model->picture;
        $initialPreview[] = Html::img($pathImg, ['class' => 'upload-image']);
    } ?>
    <div class="shop-pic">
        <?= $form->field($model, "upload_image")->label(false)->widget(FileInput::classname(), [
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
                'browseLabel' => ' Pick image',
                'browseIcon' => '<i class="glyphicon glyphicon-picture"></i>',
                'removeClass' => 'btn btn-danger btn-sm',
                'removeLabel' => ' Delete',
                'removeIcon' => '<i class="fa fa-trash"></i>',
                'previewSettings' => [
                    'image' => ['width' => '100px', 'height' => 'auto']
                ],
                'initialPreview' => $initialPreview,
            ]
        ])->label("Picture") ?>

    </div>

    <?= $form->field($model, 'address')
        ->widget(\msvdev\widgets\mappicker\MapInput::className(),
            [
                'mapCenter' => [$latitude, $longitude],
                'mapZoom' => 15,
                'apiKey' => 'AIzaSyBaSSGZhnqDf3-jB7zJYXGiS5JCjTNL4U0',
            ])->label(false); ?>

    <?= $form->field($model, 'phone_number')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>

    <?php if ($model->isNewRecord) { ?>
    <div class="row">
        <div class="col-sm-4 form-group">
            <?= $form->field($model, 'open_at')->dropDownList(
                ['1' => '1', '2' => '2','3' => '3', '4' => '4'
                    ,'5' => '5', '6' => '6' ,'7' => '7', '8' => '8'
                    ,'9' => '9', '10' => '10'
                    ,'11' => '11', '12' => '12'
                ]
            ); ?>
        </div>
        <div class="col-sm-4 form-group">
            <?= $form->field($model, 'open_at_pm_am')->dropDownList(
                ['AM' => 'AM', 'PM' => 'PM']
            )->label("AM/PM"); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4 form-group">
            <?= $form->field($model, 'close_at')->dropDownList(
                ['1' => '1', '2' => '2','3' => '3', '4' => '4'
                    ,'5' => '5', '6' => '6' ,'7' => '7', '8' => '8'
                    ,'9' => '9', '10' => '10'
                    ,'11' => '11', '12' => '12'
                ]
            ); ?>
        </div>
        <div class="col-sm-4 form-group">
            <?= $form->field($model, 'close_at_pm_am')->dropDownList(
                ['AM' => 'AM', 'PM' => 'PM']
            )->label("AM/PM"); ?>
        </div>
    </div>
    <?php  } else { ?>
        <?= $form->field($model, 'open_at')->textInput() ?>
        <?= $form->field($model, 'close_at')->textInput() ?>
    <?php }?>


<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>
