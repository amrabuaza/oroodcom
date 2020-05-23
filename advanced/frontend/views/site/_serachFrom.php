<?php


use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
    <div class="item-form">

        <?php $form = ActiveForm::begin(); ?>

        <?=
        $form->field($model, 'item_name')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\backend\models\Item::find()->all(), 'name', 'name'),
            'language' => 'en',
            'options' => ['placeholder' => 'Select a Item ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label("Item Name");

        ?>


        <?= $form->field($model, 'shop_rate')->widget(\yii2mod\rating\StarRating::class, [
            'options' => [
                // Your additional tag options
            ],
            'clientOptions' => [
                // Your client options
            ],
        ]); ?>

        <div class="row">
            <div class="col-lg-4">
                <?= $form->field($model, 'near_by_shop')->checkbox(['class' => 'nearByShop'], false) ?>
            </div>
            <div class="col-lg-6">
                <?= $form->field($model, 'lowest_price')->checkbox([], false) ?>
            </div>

            <?= $form->field($model, 'longitude')->hiddenInput()->label(false); ?>
            <?= $form->field($model, 'latitude')->hiddenInput()->label(false); ?>

        </div>
        <div class="form-group">
            <?= Html::submitButton('Search', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

<?= $this->registerJs(<<<JS
    $("#serachitem-near_by_shop").change(function() {
        if(this.checked) {
            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    console.log("xxxxsa");
                    $("#serachitem-longitude").val(position.coords.longitude);
                    $("#serachitem-latitude").val(position.coords.latitude);
                });
            } else {
                alert("Browser doesn't support geolocation!");
            }
    }
    }); 
JS
); ?>