<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PendingDefaultCategoryNameSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pending Category Names';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pending-default-category-name-index">

    <h1><?= Html::encode($this->title) ?></h1>


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
            'user_id',
            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {delete}'],
        ],
    ]); ?>


</div>
