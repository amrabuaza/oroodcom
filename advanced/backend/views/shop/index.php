<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ShopSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Shops';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Shop', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions'=>  function($model)
        {
            if($model->status=="inactive")
            {
                return ['class'=>'danger'];
            }else return ['class'=>'success'];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'status',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
