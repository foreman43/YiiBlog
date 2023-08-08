<?php

use app\models\Post;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;
use asu\tagcloud\TagCloud;

/** @var yii\web\View $this */
/** @var app\models\PostSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    //todo: Implement as a function?
    echo TagCloud::widget([
        'beginColor' => '00089A',
        'endColor' => 'A3AEFF',
        'minFontSize' => 8,
        'maxFontSize' => 15,
        'displayWeight' => false,
        'tags' => \app\models\TagPost::getTagsWeight(),
        'options' => ['style' => 'word-wrap: break-word;']
    ]);
    ?>

    <p>
        <?= !Yii::$app->user->id == 1 ? Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) : '' ?>
    </p>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => '_item',
    ]) ?>


</div>
