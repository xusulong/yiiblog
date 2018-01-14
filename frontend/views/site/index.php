<?php

/* @var $this yii\web\View */
use frontend\widgets\Banner\BannerWidget;
use frontend\widgets\post\PostWidget;
use frontend\widgets\chat\ChatWidget;
Use frontend\widgets\hot\HotWidget;
Use frontend\widgets\tag\TagWidget;
$this->title = '博客 - 首页';
?>
<div class="row">

    <div class="col-lg-9">
<?=PostWidget::widget()?>
    </div>
    <div class="col-lg-3">
        <!-- 轮播图组件 -->
        <?= BannerWidget::widget()?>
        <!-留言板组件->
        <?= ChatWidget::widget()?>
        <!-- 热门浏览组件 -->
        <?= HotWidget::widget()?>
        <!--标签云-->
        <?=TagWidget::widget();?>
    </div>
</div>
