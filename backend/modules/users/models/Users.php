<?php

namespace app\modules\users\models;

use Yii;
use yii\behaviors\TimestampBehavior;
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

    public function behaviors()
    {

        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',// 自己根据数据库字段修改
                'updatedAtAttribute' => 'updated_at', // 自己根据数据库字段修改
                'value' => time(), // 自己根据数据库字段修改
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public $password;
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
            [['username','name'], 'required'],
            [['status','name'], 'string'],
            [['created_at', 'updated_at','sex'], 'integer'],
            ['username', 'string', 'max' => 60],
            ['phone', 'string', 'max' => 15],
            [['password'], 'string', 'max' => 16],
            [['password'], 'string', 'min' => 6],
            [['auth_key','type'], 'string', 'max' => 32],
            [['password_hash'], 'string', 'max' => 65],
            [['email','role'], 'string', 'max' => 45],
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
            'name' => Yii::t('app', '姓名'),
            'phone' => Yii::t('app', '电话'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'email' => Yii::t('app', '邮箱'),
            'status' => Yii::t('app', '状态'),
            'password' => Yii::t('app', '密码'),
            'role' => Yii::t('app', '用户角色'),
            'created_at' => Yii::t('app', '创建于'),
            'updated_at' => Yii::t('app', '更新于'),
        ];
    }
}
