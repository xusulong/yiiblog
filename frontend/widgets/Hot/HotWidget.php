<?php
/**
 * Created by PhpStorm.
 * User: Alfred
 * Date: 2018/1/10
 * Time: 20:57
 */
namespace frontend\widgets\hot;
use common\models\PostExtends;
use common\models\Posts;
use Yii;
use yii\bootstrap\Widget;
use yii\base\Object;
use yii\db\Query;
class HotWidget extends Widget
{
    public $title = '';
    public $limit = 6;
    public function run()
    {
        $res = (new Query())
            ->select('a.browser,b.id,b.title')
            ->from(['a'=>PostExtends::tableName()])
            ->join('LEFT JOIN',['b'=>Posts::tableName()],'a.post_id = b.id')
            ->where('b.is_valid ='.Posts::IS_VALID)
            ->orderBy(['browser'=>SORT_DESC,'id'=>SORT_DESC])
            ->limit($this->limit)
            ->all();

        $result['title'] = $this->title?:'热门浏览';
        $result['body'] = $res?:[];
        return $this->render('index',['data'=>$result]);
    }
}