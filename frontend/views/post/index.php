<?php
/**
 * Created by PhpStorm.
 * User: Alfred
 * Date: 2018/1/2
 * Time: 22:30
 */
use frontend\widgets\post\PostWidget;
use yii\base\Widget;
use frontend\widgets\tag\TagWidget;
?>
<div class="row">
    <div class="col-lg-9">
        <?=PostWidget::widget();?>
    </div>
    <div class="col-lg-3">
        <?= TagWidget::widget();?>
    </div>
</div>
