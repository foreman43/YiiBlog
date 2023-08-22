<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Comment $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="comment-form">

    <?php
    $form = ActiveForm::begin();
    ?>

    <?= $form->field($model, 'content')->textInput(['maxlength' => true]) ?>

    <?= Yii::$app->user->id == 1
        ? $form->field($model, 'approved')->checkbox([1 => 'Одобрен'])
        : ""?>

    <div class="form-group">
        <?= Html::submitButton('Comment', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
