<?php

use common\helper\Constants;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PendingDefaultCategoryName */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=$form->field($model, 'name')->textInput()?>
    <?=$form->field($model, 'name_ar')->textInput()?>

    <div class="form-group">
        <?=Html::submitButton(Yii::t(Constants::APP, 'buttons.add'), ['class' => 'btn btn-success full-width'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
