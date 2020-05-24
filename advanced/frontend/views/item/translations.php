<?php

use backend\models\BaseCategory;
use backend\models\Item;
use common\helper\Constants;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\translations\ItemLanguage */
/* @var $shop backend\models\Shop */

if ($model->isNewRecord) {
    $this->title = Yii::t(Constants::APP, 'item.add_arabic_translations');
} else {
    $this->title = Yii::t(Constants::APP, 'item.update_arabic_translations');
}
$this->params['breadcrumbs'][] = ['label' => Yii::t(Constants::APP, 'site.view.my_shops'), 'url' => ['shop/index']];
$this->params['breadcrumbs'][] = ['label' => $shop->name, 'url' => ['shop/view?id=' . $shop->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t(Constants::APP, 'item.title'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Item::findOne($model->item_id)->name, 'url' => ['view?id=' . $model->item_id]];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="item-translations-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=$form->field($model, "item_id")->hiddenInput()->label(false)?>

    <div class="full-width">
        <?=$form->field($model, "name")->textInput(['maxlength' => true])?>
    </div>

    <div class="w-30-perc">
        <?=$form->field($model, 'description')->textarea(['maxlength' => true])?>
    </div>

    <div class="form-group">
        <?=Html::submitButton(Yii::t(Constants::APP, 'buttons.save'), ['class' => 'btn btn-success'])?>
    </div>

    <?php ActiveForm::end(); ?>
</div>