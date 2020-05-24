<?php

use common\helper\Constants;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = Yii::t(Constants::APP, "buttons.update") . " : " . $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t(Constants::APP, "site.view.profile"), 'url' => ['view']];
$this->params['breadcrumbs'][] = Yii::t(Constants::APP, "buttons.update");
?>
<div class="user-update">

    <h1><?=Html::encode($this->title)?></h1>

    <?=$this->render('_form', [
        'model' => $model,
    ])?>

</div>
