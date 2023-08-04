<?php

/** @var yii\web\View $this */

use yii\helpers\Url;

$this->title = 'User Menu';
?>
<div class="site-index">

    <!--<div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="https://www.yiiframework.com">Get started with Yii</a></p>
    </div>-->

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4 mb-3">
                <h2>Одобрить коментарий</h2>

                <p>Коментарии, ожидающие одобрения</p>

                <p><a class="btn btn-outline-secondary" href="<?php echo Url::to(['/comment/index']) ?>">Коментарии &raquo;</a></p>
            </div>
            <div class="col-lg-4 mb-3">
                <h2>Создать новую запись</h2>

                <p>Создать новую запись</p>

                <p><a class="btn btn-outline-secondary" href="<?php echo Url::to(['/post/create']) ?>">Создание записи &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Управление записями</h2>

                <p></p>

                <p><a class="btn btn-outline-secondary" href="<?php echo Url::to(['/post/index']) ?>">Управление записями &raquo;</a></p>
            </div>
        </div>

    </div>
</div>

