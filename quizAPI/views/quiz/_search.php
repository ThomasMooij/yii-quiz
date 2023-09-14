<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modelsQuizSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="quiz-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'vraag') ?>

    <?= $form->field($model, 'antwoord1') ?>

    <?= $form->field($model, 'antwoord2') ?>

    <?= $form->field($model, 'antwoord3') ?>

    <?php // echo $form->field($model, 'antwoord4') ?>

    <?php // echo $form->field($model, 'juiste_antwoord') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
