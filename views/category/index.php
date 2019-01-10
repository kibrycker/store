<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <p>
        <?= Html::a('Добавить категорию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
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
<?php
$request_checked_change = Url::home(true) . Url::to('api/request-checked-change');
$this->registerJs(<<<JS
	$('.status_checked').on('change', function() {
		var checked_status = $(this).data('status');
		var checked_model = $(this).data('model');
		var checked_id = $(this).data('id');
		//console.log(checked_status, checked_model, checked_id);
		$.ajax({
	        type: "POST",
	        url: '$request_checked_change',
	        data: {
	        	'model': checked_model,
				'status': checked_status,
				'id': checked_id
	        },
	        //dataType: 'json',
	        success: function(result) {
			    console.log(result);
		        if(result) {
			        toastr["success"]("Данные сохранены!", "Успешно!");
		        } else {
			        toastr["success"]("Данные не сохранены!", "Внимание!");
		        }
	        },
	        error: function(error) {
		        if(error) {
			        toastr["danger"]("Возникли непредвиденные ошибки!", "Ошибка!");
			    }
	        }
        });
	});
JS
);
?>