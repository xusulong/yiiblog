<?php

namespace common\models;

use common\models\base\Base;
use Yii;

/**
 * This is the model class for table "post_extends".
 *
 * @property integer $id
 * @property integer $post_id
 * @property integer $browser
 * @property integer $collect
 * @property integer $praise
 * @property integer $comment
 */
class PostExtends extends Base
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_extends';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'browser', 'collect', 'praise', 'comment'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'post_id' => Yii::t('common', 'Post ID'),
            'browser' => Yii::t('common', 'Browser'),
            'collect' => Yii::t('common', 'Collect'),
            'praise' => Yii::t('common', 'Praise'),
            'comment' => Yii::t('common', 'Comment'),
        ];
    }

    /**
     * 更新文章统计
     * @param $con
     * @param $attribute
     * @param $num
     */
    public function upCounter($con,$attribute,$num)
    {
        $counter = self::findOne($con);

        if(!$counter)
        {
            $this->setAttributes($con);
            $this->$attribute = 1;
            $this->save();
        }
        else
        {

            $countData[$attribute] = $num;
            $counter->updateCounters($countData);
        }
    }
}
