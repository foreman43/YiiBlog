<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Lookup;
use app\models\Tag;

/** @var yii\web\View $this */
/** @var app\models\PostSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="post-search">

    <?php
    $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]);

    $TagList = Tag::find()->all();

    $keyValueTagList = [];
    foreach ($TagList as $item) {
        $keyValueTagList[$item->id] = $item->name;
    }
    ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'created_at') ?>

    <?= $form->field($model, 'tagIdList')->checkboxList($keyValueTagList) ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
