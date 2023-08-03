<?php

/** @var app\models\Post $model */
/** @var \app\models\Comment[] $comments */

foreach ($comments as $comment) {
    if($comment->approved) {
        echo "<h5>{$comment->author->email}</h5>";
        echo "<p>{$comment->content}</p>";
    }
}