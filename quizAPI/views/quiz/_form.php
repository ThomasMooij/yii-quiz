<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Quiz $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="quiz-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'vraag')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'antwoord1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'antwoord2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'antwoord3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'antwoord4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'juiste_antwoord')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
