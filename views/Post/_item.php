<?php

use app\models\TagPost;
use asu\tagcloud\TagCloud;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;

/** @var \app\models\Post $model */
?>
<div>
    <a href="<?php echo Url::to(['/post/view', 'id'=>$model->id]) ?>"><h3><?php echo Html::encode($model->title); ?></h3></a>
<div>
    <?php
    echo TagCloud::widget([
        'beginColor' => '00089A',
        'endColor' => 'A3AEFF',
        'minFontSize' => 8,
        'maxFontSize' => 8,
        'displayWeight' => false,
        'tags' => TagPost::getTagsWeight($model->id),
        'options' => ['style' => 'word-wrap: break-word;']
    ]);

    echo StringHelper::truncateWords($model->getEncodedText(),50);
    echo '<p class="text-muted">' . $model->getComments()->count() . ' Comments</p>';
    ?>
</div>
<hr>
</div>