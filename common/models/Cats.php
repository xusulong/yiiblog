<?php

namespace common\models;

use common\models\base\Base;
use Yii;

/**
 * This is the model class for table "cats".
 *
 * @property integer $id
 * @property string $cat_name
 */
class Cats extends Base
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cats';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'cat_name' => Yii::t('common', 'Cat Name'),
        ];
    }
    public static function getAllCats()
    {
        $cat = ['0' => '暂无分类'];
        $res = self::find()->asArray()->all();
        if($res)
        {
            foreach ($res  as $k=>$item)
            {
                $cat[$item['id']] = $item['cat_name'];
            }
        }
        return $cat;
    }
}
