<?php
/**
 * Created by PhpStorm.
 * User: Alfred
 * Date: 2018/1/12
 * Time: 22:44
 */
namespace frontend\widgets\tag;
use common\models\Tags;
use Yii;
use yii\bootstrap\Widget;
class TagWidget extends Widget
{
    public $title ='';
    public $limit = 20;

    public function run()
    {
        $res = Tags::find()
            ->orderBy(['post_num'=>SORT_DESC])
            ->limit($this->limit)
            ->all();
        $result['title'] = $this->title?:"标签云";
        $result['body'] = $res?:[];
        return $this->render('index',['data'=>$result]);
    }
}
