<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $searchForm app\models\SearchForm */
/* @var $authors app\models\Authors */
?>

<div class="books-search">

    <div class="books-search-form">

    <?php $form = ActiveForm::begin([
        'fieldClass' => 'yii\bootstrap\ActiveField',
        'options' => [
            'class' => 'form-inline',
            'style' => 'margin-bottom:20px',
        ],
    ]); ?>

    <?= $form->errorSummary($searchForm); ?>

    <?= $form->field($searchForm, 'author_id', ['enableError' => false])
                ->dropdownList($authors, ['prompt' => 'Все авторы']) ?>

    <?= $form->field($searchForm, 'name', ['enableError' => false])->textInput(['placeholder' => 'Название']) ?>

    <?= $form->field($searchForm, 'firstPublicationDate', ['enableError' => false])
                ->widget(DatePicker::classname(), [
        'language' => 'ru',
        'dateFormat' => 'dd.MM.yyyy',
        'options' => [
            'class' => 'form-control',
        ],
        'clientOptions' => [
            'changeMonth' => true,
            'changeYear' => true,
            'yearRange' => '1920:2016',
        ]
    ])->textInput(['placeholder' => 'От']);?>

    <?= $form->field($searchForm, 'secondPublicationDate', ['enableError' => false, 'enableLabel' => false])
                ->widget(DatePicker::classname(), [
        'language' => 'ru',
        'dateFormat' => 'dd.MM.yyyy',
        'options' => [
            'class' => 'form-control',
        ],
        'clientOptions' => [
            'changeMonth' => true,
            'changeYear' => true,
            'yearRange' => '1920:2016',
        ],
    ])->textInput(['placeholder' => 'До']);?>

    <div class="form-group">
        <?= Html::submitButton('Искать', ['class' => 'btn btn-small btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

</div>