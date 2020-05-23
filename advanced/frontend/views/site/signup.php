<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">

    <div class="container" id="top-container">
        <div class="row">
            <div class="col-lg-4">
                <div class="panel panel-default panel_login body_login">

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="brand wow fadeIn">
                                    <h1 class="brand_name">
                                        <a href="/oroodcom/advanced/frontend/web/home">Oroodcom</a>
                                        <hr/>
                                    </h1>
                                </div>
                                <h2 class="welcome_mes">WELCOME!</h2>
                                <br/>
                                <br/>
                                <br/>
                                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                                <?= $form->field($model, 'email') ?>

                                <?= $form->field($model, 'password')->passwordInput() ?>
                                <div class="form-group Signup-button">
                                    <?= Html::submitButton('Signup', ['class' => 'btn btn-default', 'name' => 'login-button']) ?>
                                </div>

                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


</div>