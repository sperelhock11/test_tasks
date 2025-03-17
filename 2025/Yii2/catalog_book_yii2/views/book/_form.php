<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Book $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="book-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'year')->textInput() ?>
    <?= $form->field($model, 'isbn')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'img')->textInput(['maxlength' => true]) ?>
    <?= Html::label('Авторы'); ?>
    <?= Html::checkboxList('authors', $availableAuthors, $authors, ['multiple' => true]); ?>
    <br><br>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>

</div>
