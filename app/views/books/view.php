<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Books */

$this->title = $model->name;
?>
<div class="books-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php 
        $imagePath = ($model->preview == null) ? '/images/nocover.gif' : '/images/' . $model->preview;
        echo DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'name',
                [
                    'label' => 'Автор',
                    'value' => $model->author->firstname . " " . $model->author->lastname,
                ],
                [
                    'attribute' => 'date',
                    'format' => ['date', 'php:d F Y H:i:s'],
                ],  
                [
                    'attribute' => 'date_create',
                    'format' => ['date', 'php:d F Y H:i:s'],
                ],
                [
                    'attribute' => 'date_update',
                    'format' => ['date', 'php:d F Y H:i:s'],
                ],     
                [
                    'label' => 'Обложка',
                    'format' => 'raw',
                    'value' => Html::img(Url::base() . $imagePath, ['alt' => 'Обложка', 'style' => 'width:200px', 'class' => 'center-block']),
                ],
            ],
        ]) 
    ?>

</div>