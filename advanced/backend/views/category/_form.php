<?php

use backend\models\Shop;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?=
    $form->field($model, 'shop_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Shop::find()->all(), 'id', 'name'),
        'language' => Yii::$app->language,
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label("Shop Name");
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
