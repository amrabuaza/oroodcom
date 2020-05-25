<?php

use backend\models\User;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Shop */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="shop-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=$form->field($model, 'name')->textInput(['maxlength' => true])?>

    <?php
    $initialPreview = [];

    if (!$model->isNewRecord) {
        $pathImg = '/oroodcom/advanced/frontend/web/uploads/shops/' . $model->picture;
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
        ])->label("Picture")?>

    </div>

    <?=$form->field($model, 'phone_number')->textInput()?>

    <?=$form->field($model, 'description')->textInput(['maxlength' => true])?>

    <?php
    echo \pigolab\locationpicker\LocationPickerWidget::widget([
        'key' => 'AIzaSyBaSSGZhnqDf3-jB7zJYXGiS5JCjTNL4U0',    // optional , Your can also put your google map api key
        'options' => [
            'style' => 'width: 50%; height: 400px', // map canvas width and height
        ],
        'clientOptions' => [
            'location' => [
                'latitude' => $model->latitude,
                'longitude' => $model->longitude,
            ],
            'radius' => 300,
            'inputBinding' => [
                'latitudeInput' => new JsExpression("$('#us2-lat')"),
                'longitudeInput' => new JsExpression("$('#us2-lon')"),
                'radiusInput' => new JsExpression("$('#us2-radius')"),
                'locationNameInput' => new JsExpression("$('#us2-address')")
            ]
        ]
    ]);
    ?>

    <?=$form->field($model, 'open_at')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'close_at')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'rate')->textInput()?>

    <?=$form->field($model, 'status')->dropDownList(['active' => 'Active', 'inactive' => 'Inactive',], ['prompt' => ''])?>

    <?=
    $form->field($model, 'owner_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(User::find()->all(), 'id', 'username'),
        'language' => Yii::$app->language,
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label("Owner");
    ?>

    <div class="form-group">
        <?=Html::submitButton('Save', ['class' => 'btn btn-success'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
