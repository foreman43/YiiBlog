<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\CommentSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="comment-search">

    <?php
    $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]);

    $postList = \app\models\Post::find()->all();
    foreach ($postList as $item) {
        $keyValuePostList[$item->id] = $item->title;
    }
    ?>

    <?= $form->field($model, 'created_at') ?>

    <?= $form->field($model, 'post_id')->dropDownList($keyValuePostList) ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
