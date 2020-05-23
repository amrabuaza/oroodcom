<?php

use kartik\file\FileInput;
use kartik\select2\Select2;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Category */
/* @var $form yii\widgets\ActiveForm */

$query = new yii\db\Query();
$categories = $query->select(['name'])
    ->from('category')
    ->distinct()
    ->all();

?>
    <div class="menu-form">

        <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

        <?=
        $form->field($model, 'name')->widget(Select2::classname(), [
            'data' => ArrayHelper::map($categories, 'name', 'name'),
            'language' => 'en',
            'options' => ['placeholder' => 'Select a Category name ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label("Category Name");

        ?>

        <?=
        $form->field($model, 'shop_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\backend\models\Shop::find()->where(['owner_id' => Yii::$app->user->id])->all(), 'id', 'name'),
            'language' => 'en',
            'options' => ['placeholder' => 'Select a Shop ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label("Shop Name");

        ?>


        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Items</h4></div>
                <div class="panel-body">
                    <?php DynamicFormWidget::begin([
                        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                        'widgetBody' => '.container-items', // required: css class selector
                        'widgetItem' => '.item', // required: css class
                        'limit' => 20, // the maximum times, an element can be cloned (default 999)
                        'min' => 1, // 0 or 1 (default 1)
                        'insertButton' => '.add-item', // css class
                        'deleteButton' => '.remove-item', // css class
                        'model' => $modelsItems[0],
                        'formId' => 'dynamic-form',
                        'formFields' => [
                            'name',
                            'price',
                            'old_price',
                            'description',
                            'upload_image'
                        ],
                    ]); ?>

                    <div class="container-items"><!-- widgetContainer -->
                        <?php foreach ($modelsItems as $i => $value): ?>
                            <div class="item panel panel-default"><!-- widgetBody -->
                                <div class="panel-heading">
                                    <h3 class="panel-title pull-left">Item</h3>
                                    <div class="pull-right">
                                        <button type="button" class="add-item btn btn-success btn-xs"><i
                                                    class="glyphicon glyphicon-plus"></i></button>
                                        <button type="button" class="remove-item btn btn-danger btn-xs"><i
                                                    class="glyphicon glyphicon-minus"></i></button>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                                    <?php
                                    $initialPreview = [];
                                    // necessary for update action.
                                    if (!$value->isNewRecord) {
                                        echo Html::activeHiddenInput($value, "[{$i}]id");
                                        $item = \backend\models\Item::findOne($value->id);
                                        $pathImg = '../uploads/' . $item->picture;
                                        $value->upload_image = $pathImg;
                                        $initialPreview[] = Html::img($pathImg, ['class' => 'upload-image']);
                                    }

                                    ?>
                                    <?= $form->field($value, "[{$i}]name")->textInput(['maxlength' => true]) ?>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <?= $form->field($value, "[{$i}]old_price")->textInput(['maxlength' => true]) ?>
                                        </div>
                                        <div class="col-sm-6">
                                            <?= $form->field($value, "[{$i}]price")->textInput(['maxlength' => true]) ?>
                                        </div>
                                        <div class="col-sm-6">
                                            <?= $form->field($value, "[{$i}]description")->textInput(['maxlength' => true]) ?>
                                        </div>
                                    </div><!-- .row -->
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <?php if (!$value->isNewRecord) { ?>
                                                <?= $form->field($value, "[{$i}]upload_image")->widget(FileInput::classname(), [
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
                                                            'image' => ['width' => '138px', 'height' => 'auto']
                                                        ],
                                                        'initialPreview' => $initialPreview,
                                                        'layoutTemplates' => ['footer' => '']
                                                    ]
                                                ]) ?>
                                            <?php } else { ?>
                                                <?= $form->field($value, "[{$i}]upload_image")->widget(FileInput::classname(), [
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
                                                            'image' => ['width' => '138px', 'height' => 'auto']
                                                        ],
                                                        'layoutTemplates' => ['footer' => '']
                                                    ]
                                                ]) ?>
                                            <?php } ?>
                                        </div>
                                    </div><!-- .row -->
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php DynamicFormWidget::end(); ?>
                </div>
            </div>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
<?php



