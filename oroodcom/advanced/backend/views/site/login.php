<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
            <form id="login-form" action="/oroodcom/advanced/backend/web/login" method="post" class="login100-form validate-form">
                <input type="hidden" name="_csrf-backend"
                       value="79a4kdrgz4OJ8CoZhOKSYSnjA6tYxqg4G1IqJON-AzuMu9fdi4if6N6nR2PsseUkTYdL7TyM8VReIG1Llh1vYw==">
                <div class="form-group field-loginform-username required">
					<span class="login100-form-title p-b-33">
						Account Login
					</span>

                    <div class="wrap-input100 validate-input" data-validate="Valid username is required: ex@abc.xyz">
                        <input type="text" id="loginform-username" placeholder="Username" class="input100" name="LoginForm[username]" autofocus aria-required="true">
                        <span class="focus-input100-1"></span>
                        <span class="focus-input100-2"></span>
                    </div>


                    <div class="wrap-input100 rs1 validate-input" data-validate="Password is required">
                        <input type="password" id="loginform-password" class="input100" name="LoginForm[password]" aria-required="true" placeholder="Password">
                        <span class="focus-input100-1"></span>
                        <span class="focus-input100-2"></span>
                    </div>


                    <div class="container-login100-form-btn m-t-20">
                        <button class="login100-form-btn">
                            Sign in
                        </button>
                    </div>
            </form>
        </div>
    </div>
</div>
