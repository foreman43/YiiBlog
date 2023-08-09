<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var \app\models\Comment[] $comments */


foreach ($comments as $comment) {
    if($comment->approved) {
        echo $this->render('\..\Comment\_item', ['model' => $comment]);
    }
}