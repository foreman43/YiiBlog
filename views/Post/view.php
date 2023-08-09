<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Comment;

/** @var yii\web\View $this */
/** @var app\models\Post $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
         if(!Yii::$app->user->isGuest) {
             echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
             echo Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]);
         }
        ?>
    </p>

    <p class="text-muted">
        <small>
            Created: <?php echo Yii::$app->formatter->asRelativeTime($model->created_at) ?>
        </small>
    </p>

    <?php echo $model->getEncodedText(); ?>
    <hr>
    <div id="comments">
        <?php
        $count = $model->getComments()->count();
        echo $count > 0 ? "<h4>Comments $count</h4>" : "";
        //implement flash message
        ?>
        <div id="comments-form">
            <?php
            echo $this->render('\..\Comment\_form', ['model' => new Comment()]);
            ?>
        </div>
        <hr>

        <?php
        echo $this->render('_comments', ['comments' => $model->getComments()->all()])
        ?>
    </div>

</div>
