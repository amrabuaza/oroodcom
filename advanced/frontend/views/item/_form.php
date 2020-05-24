<?php

use backend\models\Category;
use common\helper\Constants;
use common\helper\HelperMethods;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Item */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="item-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="flex">
        <div class="p-l-r w-30-perc">
            <?=
            $form->field($model, 'category_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Category::find()->where(['shop_id' => HelperMethods::getShopIdSession()])->all(), 'id', 'name'),
                'language' => Yii::$app->language,
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label(Yii::t(Constants::APP, 'item.fields.category'));
            ?>
        </div>
        <div class="p-l-r">
            <?=$form->field($model, "name")->textInput(['maxlength' => true]);?>
        </div>
    </div>


    <div class="flex">

        <div class="p-l-r">
            <?=$form->field($model, "old_price")->textInput(['maxlength' => true])?>
        </div>

        <div class="p-l-r">
            <?=$form->field($model, "price")->textInput(['maxlength' => true])?>
        </div>

    </div>

        <div class="w-30-perc">
            <?=$form->field($model, "description")->textarea(['maxlength' => true])?>
        </div>

        <?php
        $initialPreview = [];

        if (!$model->isNewRecord) {
            echo Html::activeHiddenInput($model, "id");
            $pathImg = '../uploads/items/' . $model->picture;
            $initialPreview[] = Html::img($pathImg, ['class' => 'upload-image']);
        }
        ?>
        <div class="p-l-r w-30-perc">
            <?=$form->field($model, "upload_image")->label(Yii::t(Constants::APP, 'item.fields.picture'))->widget(FileInput::classname(), [
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
                    'browseLabel' => Yii::t(Constants::APP, 'shop.fields.pick_image'),
                    'browseIcon' => '<i class="glyphicon glyphicon-picture"></i>',
                    'removeClass' => 'btn btn-danger btn-sm',
                    'removeLabel' => Yii::t(Constants::APP, 'buttons.delete'),
                    'removeIcon' => '<i class="fa fa-trash"></i>',
                    'previewSettings' => [
                        'image' => ['width' => '100%', 'height' => '100%']
                    ],
                    'initialPreview' => $initialPreview,
                    'layoutTemplates' => ['footer' => '']
                ]
            ])?>
        </div>

    <div class="form-group">
        <?=Html::submitButton('Save', ['class' => 'btn btn-success'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
