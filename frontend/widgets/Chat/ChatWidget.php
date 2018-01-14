<?php
/**
 * Created by PhpStorm.
 * User: Alfred
 * Date: 2018/1/9
 * Time: 21:54
 */
namespace frontend\widgets\chat;

use frontend\models\FeedsForm;
use Yii;
use yii\bootstrap\Widget;
class ChatWidget extends Widget
{
    public function run()
    {
        $feed = new FeedsForm();
        $data['feed'] = $feed->getList();
        return $this->render("index",['data'=>$data]);
    }
}