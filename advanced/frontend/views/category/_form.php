<?php

use backend\models\Category;
use common\helper\Constants;
use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Category */
/* @var $form yii\widgets\ActiveForm */

$added = [];
$categories = Category::find()->all();
foreach ($categories as $category) {
    $name = $category->name;
    if (!in_array($name, $added)) {
        $added[] = ['name' => $name];
    }
}
?>
<div class="menu-form">
    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    <div class="row">
        <div class="col-lg-4">
            <?=
            $form->field($model, 'name')->widget(Select2::classname(), [
                'data' => ArrayHelper::map($added, 'name', 'name'),
                'language' => Yii::$app->language,
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label(Yii::t(Constants::APP, 'category.fields.name'));
            ?>
        </div>
    </div>
    <div class="form-group">
        <?=Html::submitButton(Yii::t(Constants::APP, 'buttons.save'), ['class' => 'btn btn-success'])?>
    </div>
    <?php ActiveForm::end(); ?>
</div>



