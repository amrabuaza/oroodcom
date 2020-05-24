<?php

use backend\models\translations\ItemLanguage;
use common\helper\Constants;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Item */
/* @var $shop backend\models\Shop */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t(Constants::APP, 'site.view.my_shops'), 'url' => ['shop/index']];
$this->params['breadcrumbs'][] = ['label' => $shop->name, 'url' => ['shop/view?id=' . $shop->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t(Constants::APP, 'item.title'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="item-view">

    <h1><?=Html::encode($this->title)?></h1>

    <p>
        <?=Html::a(Yii::t(Constants::APP, 'buttons.update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary'])?>
        <?=Html::a(Yii::t(Constants::APP, 'buttons.delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])?>
        <?php

        $itemTranslations = ItemLanguage::find()->where(["item_id" => $model->id])->count();
        if ($itemTranslations == 0) {
            print Html::a(Yii::t(Constants::APP, 'item.add_arabic_translations'), ['add-translations', 'id' => $model->id], ['class' => 'btn btn-success']);
        } else {
            print Html::a(Yii::t(Constants::APP, 'item.update_arabic_translations'), ['update-translations', 'id' => $model->id], ['class' => 'btn btn-warning']);
        }

        ?>
    </p>

    <?=DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'price',
            'old_price',
            'description',
        ],
    ])?>

</div>
