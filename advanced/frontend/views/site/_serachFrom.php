<?php


use common\helper\Constants;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $model frontend\models\Item */

?>
    <div class="item-form">

        <?php $form = ActiveForm::begin(); ?>

        <?=
        $form->field($model, 'item_name')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\backend\models\Item::find()->all(), 'name', 'name'),
            'language' => Yii::$app->language,
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label(Yii::t(Constants::APP, 'item.search.fields.item_name'));

        ?>


        <?=$form->field($model, 'shop_rate')->widget(\yii2mod\rating\StarRating::class, [
            'options' => [
                // Your additional tag options
            ],
            'clientOptions' => [
                // Your client options
            ],
        ]);?>

        <div class="row">
            <div class="col-lg-4">
                <?=$form->field($model, 'near_by_shop')->checkbox(['class' => 'nearByShop'], false)?>
            </div>
            <div class="col-lg-6">
                <?=$form->field($model, 'lowest_price')->checkbox([], false)?>
            </div>

            <?=$form->field($model, 'longitude')->hiddenInput()->label(false);?>
            <?=$form->field($model, 'latitude')->hiddenInput()->label(false);?>

        </div>
        <div class="form-group">
            <?=Html::submitButton(Yii::t(Constants::APP, 'site.index.search'), ['class' => 'btn btn-success full-width'])?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

<?=$this->registerJs(<<<JS
    $("#serachitem-near_by_shop").change(function() {
        if(this.checked) {
            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    $("#serachitem-longitude").val(position.coords.longitude);
                    $("#serachitem-latitude").val(position.coords.latitude);
                });
            } else {
                alert("Browser doesn't support geolocation!");
            }
    }
    }); 
JS
);?>