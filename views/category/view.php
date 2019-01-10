<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="category-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить категорию', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить категорию?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'name',
            'symbolik_name',
            [
                'attribute' => 'logo',
                //'filter' => [1 => 'Да', 0 => 'Нет'],
                //'value' => $model->logo?'<img src="'. $model->logo .'" title="'. $model->name .'" width="150">':false,
                'value' => $model->logo?Html::img($model->logo, ['width' => '150']):false,
                'format' => 'raw',
            ],
            //'logo:ntext',
            'description:ntext',
            [
                'attribute' => 'status',
                'value' => function($data){
                        return ($data->status == 1) ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
                    },
                'format' => 'raw',
            ],
            //'status',
            'date_create',
            'date_update',
        ],
    ]) ?>

</div>
