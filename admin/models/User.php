<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $openid
 * @property string $nickname
 * @property string $headimgurl
 * @property integer $sex
 * @property string $city
 * @property string $province
 * @property string $phone
 * @property string $auth_key
 * @property string $password_hash
 * @property string $email
 * @property string $status
 * @property string $role
 * @property string $reg_ip
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $password;
    public $passwordok;

    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'status', 'updated_at'], 'required'],
            [['sex', 'created_at', 'updated_at'], 'integer'],
            [['status', 'role'], 'string'],
            [['username'], 'string', 'max' => 60],
            [['auth_key'], 'string', 'max' => 32],
            [['password_hash'], 'string', 'max' => 65],
            [['email'], 'string', 'max' => 45],
            [['password','passwordok'], 'string', 'max' => 16],
            [['password','passwordok'], 'string', 'min' => 6],
            ['passwordok', 'compare','compareAttribute'=>'password','message'=>'两次密码必须一致'],
            [['email'], 'unique'],
            [['username'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => '新密码',
            'passwordok' => '确认密码',
            'phone' => '电话',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'email' => 'Email',
            'status' => 'Status',
            'role' => '用户角色',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
