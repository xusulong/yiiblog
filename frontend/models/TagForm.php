<?php
/**
 * Created by PhpStorm.
 * User: Alfred
 * Date: 2018/1/4
 * Time: 22:44
 */
namespace frontend\models;
use common\models\Tags;
use yii\base\Model;
use yii;
/**
 * Class TagForm 标签的表单模型
 * @package frontend\models
 */
class TagForm extends Model
{
    public $id;
    public $tags;
    public function rules()
    {
        return [
            //规则：必填，可遍历，内容是字符串
            ['tags','required'],
            ['tags','each','rule'=>['string']]
        ];
    }
    public function saveTags()
    {
        $ids = [];
        if(!empty($this->tags))
        {
            foreach ($this->tags as $tag)
            {
                $ids[] = $this->_saveTag($tag);
            }
        }
        //var_dump($ids);
        //exit;
        return $ids;
    }

    /**
     * 保存标签
     */
    private function _saveTag($tag)
    {

        $model = new Tags();
        /* 存在约束，不能单独插入？？？
        $model->tag_name = 'ceshisdsdsdasdfasdfasdf';
        $model->post_num = 1;
        var_dump($model);
        $t = $model->save();
*/
        $res = $model::find()->where(['tag_name'=>$tag])->one();
        if(!$res)
        {//新建标签
            var_dump('新建标签');
            $model->tag_name = $tag;
            $model->post_num = 1;
            if(!$model->save()){
                throw new \Exception('保存标签失败');
            }
            var_dump('新建标签成功');
            return $model->id;
        }
        else {
            var_dump('跟新标签');
            $res->updateCounters(['post_num' => 1]);
            return $res->id;
        }
        exit;
    }
}