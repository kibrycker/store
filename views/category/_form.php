<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php if(!$model->isNewRecord) : ?>
    <?= $form->field($model, 'symbolik_name')->textInput(['maxlength' => true]) ?>
    <?php endif; ?>

    <?//= $form->field($model, 'logo')->textarea(['rows' => 6]) ?>
    <?= $model->logo?Html::img($model->logo, ['width' => '150']):false ?>
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
