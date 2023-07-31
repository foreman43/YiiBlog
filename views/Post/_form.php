<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \app\models\Lookup;
use \app\models\Tag;

/** @var yii\web\View $this */
/** @var app\models\Post $model */
/** @var app\models\TagPost $modelTP */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="post-form">

    <?php
    $statusList = Lookup::find()->all();
    foreach ($statusList as $item) {
        $keyValueStatList[] = [$item->id => $item->name];
    }

    /*$TagList = Tag::find()->all();
    foreach ($TagList as $item) {
        $keyValueTagList[] = [$item->id => $item->name];
    }*/

    $form = ActiveForm::begin();
    ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->dropDownList($keyValueStatList) ?>

    <?php
    //todo: find how to implement tags (most likely subForm)
    //$form->field($modelTP, 'content')->checkboxList($keyValueTagList) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
