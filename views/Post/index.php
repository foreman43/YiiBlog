<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use asu\tagcloud\TagCloud;
use \app\models\TagPost;

/** @var yii\web\View $this */
/** @var app\models\PostSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    echo TagCloud::widget([
        'beginColor' => '00089A',
        'endColor' => 'A3AEFF',
        'minFontSize' => 8,
        'maxFontSize' => 15,
        'displayWeight' => false,
        'tags' => TagPost::getTagsWeight(),
        'options' => ['style' => 'word-wrap: break-word;']
    ]);
    ?>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => '_item',
    ]) ?>


</div>
