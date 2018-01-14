<?php

namespace common\models;

use Yii;
use common\models\base\Base;
/**
 * This is the model class for table "posts".
 *
 * @property integer $id
 * @property string $title
 * @property string $summary
 * @property string $content
 * @property string $label_img
 * @property integer $cat_id
 * @property integer $user_id
 * @property string $user_name
 * @property integer $is_valid
 * @property integer $created_at
 * @property integer $updated_at
 */
class Posts extends Base
{
    const IS_VALID = 1;//发布
    const NO_VALID = 0;//未发布

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * 关联文章标签关系表
     * @return \yii\db\ActiveQuery
     */
    public function getRelate()
    {
        //echo '<pre>'; print_r($this->hasMany(RelationPostTags::className(),['post_id'=>'id']));exit;
        return $this->hasMany(RelationPostTags::className(),['post_id'=>'id']);
    }

    /**
     * 关联文章统计表
     * @return \yii\db\ActiveQuery
     */
    public function getExtend()
    {
        return $this->hasOne(PostExtends::className(),['post_id'=>'id']);
    }

    /**
     * 关联标签表
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(Cats::className(),['id'=>'cat_id']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['cat_id', 'user_id', 'is_valid', 'created_at', 'updated_at'], 'integer'],
            [['title', 'summary', 'label_img', 'user_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'summary' => '简介',
            'content' => '内容',
            'label_img' => '表情图',
            'cat_id' => '分类',
            'user_id' => '用户ID',
            'user_name' => '用户名',
            'is_valid' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
}
