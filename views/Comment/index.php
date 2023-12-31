<?php

use app\models\Comment;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\CommentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Comments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Comment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'content',
                'label' => 'Comment',
                'value' => 'content'
            ],
            [
                'attribute' => 'approved',
                'label' => 'Approved',
                'value' => 'approvedValue'
            ],
            'created_at',
            [
                'attribute' => 'post_id',
                'label' => 'Post',
                'value' => 'postTitle'
            ],
            [
                'attribute' => 'author_id',
                'label' => 'Author',
                'value' => 'authorEmail'
            ],
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Comment $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
