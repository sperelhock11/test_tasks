<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\storage $model */

$this->title = 'Создать';
$this->params['breadcrumbs'][] = ['label' => 'Склад', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="storage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
