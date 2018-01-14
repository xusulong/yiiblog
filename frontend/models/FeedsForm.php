<?php
/**
 * Created by PhpStorm.
 * User: Alfred
 * Date: 2018/1/9
 * Time: 21:46
 */
namespace  frontend\models;
use common\models\Feeds;
use yii\base\Model;
use Yii;
class FeedsForm extends Model
{
    public $content;
    public $_lastError;
    public function rules()
    {
        return [
            ['content','required'],
            ['content','string','max'=>255]
        ];
    }
    public function attributeLabels()
    {
        return [
            'id'=>'ID',
            'content' =>'内容'
            ];
    }
    public function  getList()
    {
        $model = new Feeds();
        $res=$model->find()->limit(10)
            ->with('user')->orderBy(['id'=>SORT_DESC])
            ->asArray()
            ->all();
        return $res?:[];
    }

    /**
     * 留言保存
     * @return bool
     */
    public function create()
    {
        try {
            $model = new Feeds();
            $model->user_id = Yii::$app->getUser()->identity->getId();
            $model->content = $this->content;
            $model->created_at = time();

            if(!$model->save())
                throw new \Exception('保存失败！');

            return true;
        }catch(\Exception $e)
        {
            $this->_lastError = $e->getMessage();
            return false;
        }

    }
}