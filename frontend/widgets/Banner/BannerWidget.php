<?php
/**
 * Created by PhpStorm.
 * User: Alfred
 * Date: 2018/1/9
 * Time: 20:01
 */
namespace frontend\widgets\Banner;
use Yii;
use yii\bootstrap\Widget;
class BannerWidget extends Widget
{
    public $items = [];
    public function init()
    {
        if(empty($this->item))
        {
            $this->items = [
                ['label'=>'demo','img_url'=>'/statics/images/banner/444H.jpg','url'=>['site/index'],'html'=>'阿斯顿发顺丰','active' =>'active'],
                ['label'=>'demo','img_url'=>'/statics/images/banner/440H.jpg','url'=>['site/index'],'html'=>''],
                ['label'=>'demo','img_url'=>'/statics/images/banner/400H.jpg','url'=>['site/index'],'html'=>''],
            ];
        }

    }
    public function run()
    {
        $data['items'] = $this->items;
        return $this->render('index',['data'=>$data]);
    }
}