<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use app\assets\BooksAsset;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchForm yii\data\SearchForm */

BooksAsset::register($this);    //Ajax and modal window initialize
?>

<div class="books-index">
    <?php
        echo $this->render('_searchform', ['searchForm' => $searchForm, 'authors' => $authors]);
        $gridColumns =
        [
            'id',
            'name',
            [
                'attribute' => 'preview',
                'format' => 'raw',
                'contentOptions' => ['style' => 'text-align: center;'],
                'enableSorting' => false,
                'value' => function($model){
                    return Html::a($model->getBookCoverImageTag(), '#', [
                        'class' => 'activity-image-link',
                        'title' => 'Увеличить',
                        'data-toggle' => 'modal',
                        'data-target' => '#activity-modal',
                        'data-id' => $model->id,
                    ]);
                }
            ],
            [
                'attribute' => 'author_id',
                'value' => function($model)
                {
                    return $model->author->firstname . " " . $model->author->lastname;
                }
            ],
            [
                'attribute' => 'date',
                'format' => ['date', 'php:d F Y'],
            ],  
            [
                'attribute' => 'date_create',
                'format' => ['date', 'php:d F Y'],
            ],
            [
                'attribute' => 'date_update',
                'format' => ['date', 'php:d F Y'],
            ],          
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Действия',
                'contentOptions' => ['class' => 'text-center','style' => 'vertical-align: middle'],
                'buttons' => 
                [
                    'view' => function ($url, $model, $key){
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '#', [
                                    'class' => 'activity-view-link',
                                    'title' => 'Подробно',
                                    'data-toggle' => 'modal',
                                    'data-target' => '#activity-modal',
                                    'data-id' => $model->id,
                        ]);
                    },
                    'update' => function($url, $model)
                    {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, ['title' => 'Редактировать']);
                    },
                    'delete' => function($url, $model)
                    {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, 
                        [
                            'title' => 'Удалить',
                            'data' => [
                                'confirm' => "Вы дейсвительно хотите удалить книгу?",
                                'method' => 'post',
                            ]
                        ]);
                    },        
                ],
            ],
        ];
    ?>
    
    <?php

        //GridView

        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns'=>$gridColumns,
        ]);
    ?>

    <?php 

        //Modal window for Book and Image 

        Modal::begin(
        [
            'id' => 'activity-modal',
            'header' => '<h4 class="modal-title"></h4>',
            'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Закрыть</a>',
        ]);
    ?>
    <?php Modal::end(); ?>
</div>