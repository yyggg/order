<?php

namespace app\modules\users\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $type
 * @property string $telephone
 * @property string $website
 * @property string $auth_key
 * @property string $password_hash
 * @property string $email
 * @property string $status
 * @property string $ip
 * @property integer $created_at
 * @property integer $updated_at
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
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
            [['username', 'type', 'auth_key', 'password_hash', 'email', 'status', 'ip', 'updated_at'], 'required'],
            [['type', 'status'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['username'], 'string', 'max' => 60],
            [['phone', 'ip'], 'string', 'max' => 15],
            [['website'], 'string', 'max' => 250],
            [['auth_key'], 'string', 'max' => 32],
            [['password_hash'], 'string', 'max' => 65],
            [['email'], 'string', 'max' => 45],
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
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', '用户名'),
            'type' => Yii::t('app', '类型'),
            'phone' => Yii::t('app', '电话'),
            'website' => Yii::t('app', '网站'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'email' => Yii::t('app', '邮箱'),
            'status' => Yii::t('app', '状态'),
            'reg_ip' => Yii::t('app', '注册IP'),
            'created_at' => Yii::t('app', '创建于'),
            'updated_at' => Yii::t('app', '更新于'),
        ];
    }
}
