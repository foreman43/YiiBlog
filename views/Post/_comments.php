<?php

/** @var app\models\Post $model */
/** @var \app\models\Comment[] $comments */

use yii\helpers\Html;

foreach ($comments as $comment) {
    if($comment->approved) {
        echo "<h5>{$comment->author->email}</h5>";
        echo "<p>{$comment->content}</p>";
        if(!Yii::$app->user->isGuest && Yii::$app->user->id == 1) {
            if(!$comment->approved) {
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
    }
}