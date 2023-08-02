<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;

/** @var \app\models\Post $model */
?>
<div>
    <a href="<?php echo Url::to(['/post/view', 'id'=>$model->id]) ?>"><h3><?php echo Html::encode($model->title); ?></h3></a>
<div>
    <?php
    echo StringHelper::truncateWords($model->getEncodedText(),50);
    //todo: add some style difference to comments count
    echo '<p>' . $model->getComments()->count() . ' Comments</p>';
    ?>
</div>
<hr>
</div>