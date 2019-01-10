<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Бренды';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brands-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <p>
        <?= Html::a('Добавить бренд', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'symbolik_name',
            [
                'attribute' => 'logo',
                //'filter' => [1 => 'Да', 0 => 'Нет'],
                'content' => function($data){
                        return $data->logo?Html::img($data->logo, ['width' => '100']):false;
                        //return $data->logo?'<img src="'. $data->logo .'" title="'. $data->name .'" width="150">':false;
                    }
            ],
            //'logo:ntext',
            //'description:ntext',
            [
                'attribute' => 'status',
                'filter' => [1 => 'Да', 0 => 'Нет'],
                'content' => function($data){
                        //return ($data->status == 1) ? '<i class="fa fa-thumbs-up fa-3x" aria-hidden="true"></i>' : '<i class="fa fa-thumbs-down fa-3x" aria-hidden="true"></i>';
                        return '<input type="checkbox"'. (($data->status == 1) ? ' checked' : '') . ' data-toggle="toggle" data-size="normal" data-model="'. Yii::$app->controller->id .'" data-id="'. $data->id .'" data-status="'. $data->status .'" class="status_checked">';
                    }
            ],
            //'status',
            //'date_create',
            //'date_update',

            ['class' => 'yii\grid\ActionColumn',
                'template' => "{view}<br />{update}<br />{delete}",
                'buttons' => [
                    'view' => function($url, $model) {
                            return Html::a('<i class="far fa-eye" aria-hidden="true"></i>', $url, ['title' => '']);
                        },
                    'update' => function($url, $model) {
                            return Html::a('<i class="fas fa-edit"></i>', $url, ['title' => '']);
                        },

                    'delete' => function($url, $model) {
                            return Html::a('<i class="fas fa-trash-alt"></i>', $url, ['title' => '',
                                'data' => [
                                    'method' => 'post',
                                    'confirm' => Yii::t('app', 'Вы действительно хотите удалить данную запись?'),
                                ]
                            ]);
                        }
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
