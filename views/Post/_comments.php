<?php

/** @var app\models\Post $model */
/** @var \app\models\Comment[] $comments */

if(!Yii::$app->user->isGuest) {
    //todo: implement render of comment form or just form
}

foreach ($comments as $comment) {
    echo "<h5>{$comment->author->email}</h5>";
    echo "<p>{$comment->content}</p>";
}