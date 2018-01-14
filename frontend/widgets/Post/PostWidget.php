<?php
/**
 * Created by PhpStorm.
 * User: Alfred
 * Date: 2018/1/6
 * Time: 21:37
 */
namespace  frontend\widgets\post;
use common\models\Posts;
use frontend\models\PostForm;
use Yii;
use yii\base\Widget;
use yii\data\Pagination;
use yii\helpers\Url;

/**
 * 文章列表组件
 * Class PostWidget
 * @package frontend\widgets\post
 */
class PostWidget extends Widget
{
    /**
     * 文章标题
     * @var string
     */
    public $title = '';
    /**
     * 显示条数
     * @var int
     */
    public $limit = 6;
    /**
     * 是否显示更多
     * @var bool
     */
    public $more = true;
    /**
     * 是否显示分页
     * @var bool
     */
    public $page = true;
    public function run()
    {
        $curPage = Yii::$app->request->get('page',1);
        //查询条件
        $cond = ['=','is_valid',Posts::IS_VALID];
        $res = PostForm::getList($cond,$curPage,$this->limit);
        $result['title']  = $this->title?:"最新文章";
        $result['more'] = Url::to('/post/index');
        $result['body'] = $res['data']?:[];
        //是否显示分页
        if($this->page)
        {
            $pages = new Pagination(['totalCount'=>
                    $res['count'],'pageSize' =>$res['pageSize'] ]);
            $result['page'] = $pages;
        }
        return $this->render("index",['data'=>$result]);
    }
}