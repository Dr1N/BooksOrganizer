<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'My Library';
?>
<div class="site-index">
    <div class="jumbotron">
        <h1>Библиотека</h1>
        <?php if(Yii::$app->user->isGuest): ?>
           <p><?= 'Для получения доступа к книгам авторируйтесь' ?></p>
           <?= Html::a('Войти', ['site/login'], ['class' => 'btn  btn-success']) ?>
        <?php else: ?>
            <p><?= 'Добро пожалвать <strong>' . Yii::$app->user->identity->username . '</strong>' ?></p>
            <?= Html::a('Поехали!', ['/books'], ['class' => 'btn  btn-success']); ?>
        <?php endif ?>
    </div>
</div>