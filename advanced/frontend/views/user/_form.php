<?php

use common\helper\Constants;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>


    <?php if (!$model->isNewRecord) { ?>
        <div class="btn btn-info btn-sm password-click"><?= Yii::t(Constants::APP,"buttons.edit_password") ?></div>

        <div class="pass-in">
            <br/>
            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
        </div>
        <br/>
    <?php } else {
        echo $form->field($model, 'password')->passwordInput(['maxlength' => true]);
    } ?>

    <br/>

    <div class="form-group">
        <?= Html::submitButton(Yii::t(Constants::APP,"buttons.save"), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
