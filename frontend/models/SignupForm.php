<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;
use Yii;
/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $rePassword;
    public $verifyCode;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'string', 'min' => 2, 'max' => 16],
            ['username', 'match','pattern'=>'/^[(\x{4E00}-\x{9FA5})a-zA-Z]+[(\x{4E00}-\x{9FA5})a-zA-Z_\d]*$/u','message'=>'用户名由字母，汉字，数字，下划线组成，且不能以数字和下划线开头。'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => yii::t('common','This username has already been taken.')],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => yii::t('common','This email address has already been taken.')],

            [['password','rePassword'], 'required'],
            [['password','rePassword'], 'string', 'min' => 6],

            ['rePassword','compare','compareAttribute'=>'password','message'=>yii::t('common','Two times password is not same')],
            ['verifyCode','captcha']
        ];
    }
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('common','Login Name'),
            'email' =>Yii::t('common','Email'),
            'password' =>Yii::t('common','Password'),
            'rePassword'=>'确认密码',
            'verifyCode'=>'验证码',
            'Signup' =>Yii::t('common','Signup'),

        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
