<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Books */
/* @var $authors app\models\Authors */

$this->title = 'Редактирование книги: ' . $model->name;
?>
<div class="books-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="books-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        
    <?= $form->field($model, 'author_id')->dropdownList($authors) ?>
    
    <?= $form->field($model, 'strDate')->widget(DatePicker::classname(), [
        'language' => 'ru',
        'dateFormat' => 'php: d.m.Y',
        'options' => [
            'class' => 'form-control',
        ],
        'clientOptions' => [
            'changeMonth' => true,
            'changeYear' => true,
            'yearRange' => '1920:2016',
        ],
    ])?>

    <?= $form->field($model, 'cover')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

</div>