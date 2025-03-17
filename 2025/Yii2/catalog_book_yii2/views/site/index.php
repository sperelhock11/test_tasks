<?php

use yii\bootstrap5\Html;

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">ТОП 10!</h1>
        <p class="lead">ТОП 10 авторов выпуствиших больше книг за какой-то год</p>
    </div>
    <div class="body-content">
        <div class="row">
        <?php foreach ($top as $year => $list) { ?>
            <div class="col-lg-6">
                <h2><?= Html::encode($year) ?></h2>
                <table class="table">
                    <tr>
                        <th>ФИО</th>
                        <th>Количество изданых книг</th>
                    </tr>
                    <?php foreach ($list as $elem) { ?>
                        <tr>
                            <td><?= Html::encode($elem['fio']) ?></td>
                            <td><?= Html::encode($elem['total']) ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        <?php } ?>
        </div>
    </div>
</div>
