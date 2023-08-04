<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var \app\models\Comment[] $comments */


foreach ($comments as $comment) {
    if($comment->approved || Yii::$app->user->id == 1) {
        echo $this->render('\..\Comment\_item', ['model' => $comment]);
    }
}