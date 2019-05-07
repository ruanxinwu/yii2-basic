<?php

namespace app\models\db;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "sail_company".
 *
 * @property int $id
 * @property string $company_name 公司名字
 * @property int $company_type 公司类型1,2第三方公司
 * @property int $shop_num 店铺数量
 * @property int $is_del 删除0否，1是
 * @property string $email
 * @property string $pwd
 * @property string $salt 随机数
 * @property string $token token
 * @property string $leading_official 负责人
 */
class SailCompany extends \yii\db\ActiveRecord implements IdentityInterface
{
    private static $config = [
        'string' => 'QOqL1W#bJU^9Yu0D',
        'length' => '8',
        'prefix' => 'mp001',
    ];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sail_company';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_type', 'shop_num', 'is_del'], 'integer'],
            [['pwd'], 'required'],
            [['company_name', 'token'], 'string', 'max' => 64],
            [['email', 'leading_official'], 'string', 'max' => 255],
            [['pwd'], 'string', 'max' => 120],
            [['salt'], 'string', 'max' => 8],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_name' => 'Company Name',
            'company_type' => 'Company Type',
            'shop_num' => 'Shop Num',
            'is_del' => 'Is Del',
            'email' => 'Email',
            'pwd' => 'Pwd',
            'salt' => 'Salt',
            'token' => 'Token',
            'leading_official' => 'Leading Official',
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return 233333;
        //return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public static function findByUsername($username)
    {
        return static::findOne([
            'email' => $username,
            'is_del' => 0
        ]);
    }

    public function validatePassword($password)
    {
        return $this->pwd === sha1(md5($password) . md5(self::$config['string'] . $this->salt));
    }
}
