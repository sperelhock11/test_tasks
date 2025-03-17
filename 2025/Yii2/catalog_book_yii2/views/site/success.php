<?php
use yii\bootstrap5\Html;

$this->title = 'Подписка оформлена!';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-lg-5">
            <p>Вы успешно подписались, когда книга появится Вам придет уведомление.</p>
        </div>
    </div>
</div>
