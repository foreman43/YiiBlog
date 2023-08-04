<?php

/** @var app\models\Comment $model */

use yii\helpers\Html;

echo "<h5>{$model->author->email}</h5>";
$time = Yii::$app->formatter->asRelativeTime($model->created_at);
echo "<small class='text-muted'>$time</small>";
echo "<p>{$model->content}</p>";
if(!Yii::$app->user->isGuest && Yii::$app->user->id == 1) {
    if(!$model->approved) {
        echo Html::a('Approve', ['approve', 'id' => $model->id], ['class' => 'btn btn-primary']);
    }
    //todo: Implement comment deleting
    /* echo Html::a('Delete', ['delete', 'id' => $comment->id], [
       'class' => 'btn btn-danger',
       'data' => [
           'confirm' => 'Are you sure you want to delete this item?',
           'method' => 'post',
       ],
   ]);*/
}