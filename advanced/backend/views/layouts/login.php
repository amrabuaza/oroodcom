<?php
/* @var $this \yii\web\View */

/* @var $content string */

use backend\assets\Login;
use yii\helpers\Html;
use common\widgets\Alert;

Login::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language?>">
<head>
    <meta charset="<?=Yii::$app->charset?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?=Html::csrfMetaTags()?>
    <title><?=Html::encode($this->title)?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php

    ?>
    <div class="container">
        <?=Alert::widget()?>
        <?=$content?>
    </div>
</div>


<?php
if (class_exists('yii\debug\Module')) {
    $this->off(\yii\web\View::EVENT_END_BODY, [\yii\debug\Module::getInstance(), 'renderToolbar']);
}
?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
