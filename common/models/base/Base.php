<?php
/**
 * Created by PhpStorm.
 * User: Alfred
 * Date: 2018/1/2
 * Time: 22:45
 */
namespace common\models\base;

use yii\db\ActiveRecord;
/**
 * Class Base 基础模型类
 * @package common\models
 */
class Base extends ActiveRecord
{
    public function getPages($query,$curPage=1,$pageSize = 10,$search = null)
    {
        if($search)
            $query = $query->andFilterWhere($search);
        $data['count'] = $query->count();
        if(!$data['count'])
        {
            return ['count'=>0,'curPage'=>$curPage
                ,'pageSize' =>$pageSize,'start'=>0,
                'end'=>0,'data'=>[]];
        }
        //超过实际页数，不取curPage为当前页
        $curPage = (ceil($data['count']/$pageSize)<$curPage)
            ?ceil($data['count']/$pageSize):$curPage;
        $data['curPage'] = $curPage;
        $data['pageSize'] = $pageSize;
        //起始页
        $data['start'] = ($curPage-1)*$pageSize+1;
       //末页
        $data['end'] = (ceil($data['count']/$pageSize)== $curPage)
            ?$data['count']:($curPage-1)*$pageSize+$pageSize;
        //数据
        $data['data'] = $query->offset(($curPage-1)*$pageSize)
            ->limit($pageSize)
            ->asArray()
            ->all();
        return $data;
    }
}