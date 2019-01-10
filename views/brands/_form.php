<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Brands */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="brands-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'symbolik_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'logo')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'logo')->fileInput([]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->dropDownList([1 => 'Активен', 0 => 'Неактивен']) ?>

    <?//= $form->field($model, 'date_create')->textInput() ?>

    <?//= $form->field($model, 'date_update')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
