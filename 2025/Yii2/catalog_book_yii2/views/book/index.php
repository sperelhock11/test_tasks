<?php

use app\models\Book;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Книги';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->user->can('allInclusive')) { ?>
        <p>
            <?= Html::a('Добавить книгу', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php } ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name',
            'year',
            'isbn',
            'img',
            [
                'attribute' => 'Авторы',
                'value' => function($model){
                    $items = [];
                    foreach($model->authors as $author){
                        $items[] = $author->fio;
                    }
                    return implode(', ', $items);
                }
            ],
            [
                'attribute' => 'Склад',
                'format' => 'raw',
                'value' => function($model){
                    $items = [];
                    foreach ($model->storages as $storage) {
                        if ($storage->quantity !== 0) {
                            $items[] = "Есть: $storage->quantity по $storage->price";
                        }
                        
                    }
                    if (count($items) > 0) {
                        return Html::encode(implode('. ', $items));
                    }

                    return Html::a('Уведомить при поступлении', '/site/subscription?bookId=' . $model->id);
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Book $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                },
                'visibleButtons' => [
                    'update' => function ($model) {
                        return Yii::$app->user->can('allInclusive');
                    },
                    'delete' => function ($model) {
                        return Yii::$app->user->can('allInclusive');
                    },
                ]
            ]
        ],
    ]); ?>


</div>
