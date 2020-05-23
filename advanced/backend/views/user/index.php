<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions'=>  function($model)
        {
            if($model->status=="9")
            {
                return ['class'=>'danger'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'username',
            'type',
            'email:email',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
