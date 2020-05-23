<?php

use kartik\file\FileInput;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="container-items"><!-- widgetContainer -->
    <div id="panel-option-values" class="panel panel-default">


        <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
            'widgetBody' => '.container-items', // required: css class selector
            'widgetItem' => '.item', // required: css class
            'limit' => 20, // the maximum times, an element can be cloned (default 999)
            'min' => 1, // 0 or 1 (default 1)
            'insertButton' => '.add-item', // css class
            'deleteButton' => '.remove-item', // css class

            'model' => $modelsItems[0],
            'formId' => 'dynamic-form',
            'formFields' => [
                'name',
                'price',
                'old_price',
                'description',
                'upload_image'
            ]
        ]); ?>
<div class="container-items">
        <table class="item table table-bordered table-striped margin-b-none">
            <thead>
            <tr>
                <th style="width: 188px;">name</th>
                <th style="width: 188px;">old_price</th>
                <th style="width: 188px;">price</th>
                <th style="width: 188px;">description</th>
                <th style="width: 188px;">upload_image</th>
                <th style="width: 90px; text-align: center">Actions</th>
            </tr>
            </thead>
            <tbody class="form-options-body">
            <?php foreach ($modelsItems as $index => $modelsItems): ?>
                <tr class=" form-options-item">
                    <td class="vcenter">
                        <?= $form->field($modelsItems, "[{$index}]name")->label(false)->textInput(['maxlength' => 128]); ?>
                    </td>
                    <td class="vcenter">
                        <?= $form->field($modelsItems, "[{$index}]old_price")->label(false)->textInput(['maxlength' => true]) ?>
                    </td>
                    <td class="vcenter">
                        <?= $form->field($modelsItems, "[{$index}]price")->label(false)->textInput(['maxlength' => true]) ?>
                    </td>
                    <td class="vcenter">
                        <?= $form->field($modelsItems, "[{$index}]description")->label(false)->textInput(['maxlength' => true]) ?>
                    </td>
                    <td>
                        <?php
                        $initialPreview = [];

                        if (!$modelsItems->isNewRecord) {
                            $item = \backend\models\Item::findOne($modelsItems->id);
                            if($item == null)
                            {
                                echo("item is null");
                            }
                            echo Html::activeHiddenInput($modelsItems, "[{$index}]id");
                            $pathImg = '../uploads/' . $item->picture;
                            $initialPreview[] = Html::img($pathImg, ['class' => 'upload-image']);
                        }
                        ?>
                        <?= $form->field($modelsItems, "[{$index}]upload_image")->label(false)->widget(FileInput::classname(), [
                            'options' => [
                                'multiple' => false,
                                'accept' => 'image/*',
                                'class' => 'optionvalue-img'
                            ],
                            'pluginOptions' => [
                                'previewFileType' => 'image',
                                'showCaption' => false,
                                'showUpload' => false,
                                'browseClass' => 'btn btn-default btn-sm',
                                'browseLabel' => ' Pick image',
                                'browseIcon' => '<i class="glyphicon glyphicon-picture"></i>',
                                'removeClass' => 'btn btn-danger btn-sm',
                                'removeLabel' => ' Delete',
                                'removeIcon' => '<i class="fa fa-trash"></i>',
                                'previewSettings' => [
                                    'image' => ['width' => '100px', 'height' => 'auto']
                                ],
                                'initialPreview' => $initialPreview,
                                'layoutTemplates' => ['footer' => '']
                            ]
                        ]) ?>

                    </td>
                    <td class="text-center vcenter">
                        <button type="button" class="add-item btn btn-success btn-xs"><i
                                    class="glyphicon glyphicon-plus"></i></button>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
</div>
        <?php DynamicFormWidget::end(); ?>
    </div>
</div>
<?php
$js = <<<'EOD'

$(".optionvalue-img").on("filecleared", function(event) {
    var regexID = /^(.+?)([-\d-]{1,})(.+)$/i;
    var id = event.target.id;
    var matches = id.match(regexID);
    if (matches && matches.length === 4) {
        var identifiers = matches[2].split("-");
        $("#optionvalue-" + identifiers[1] + "-deleteimg").val("1");
    }
});

var fixHelperSortable = function(e, ui) {
    ui.children().each(function() {
        $(this).width($(this).width());
    });
    return ui;
};

$(".form-options-body").sortable({
    items: "tr",
    cursor: "move",
    opacity: 0.6,
    axis: "y",
    handle: ".sortable-handle",
    helper: fixHelperSortable,
    update: function(ev){
        $(".dynamicform_wrapper").yiiDynamicForm("updateContainer");
    }
}).disableSelection();

EOD;

\frontend\assets\AppAsset::register($this);
$this->registerJs($js);
?>
