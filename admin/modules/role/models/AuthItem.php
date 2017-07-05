<?php

namespace app\modules\role\models;

use Yii;

/**
 * This is the model class for table "{{%auth_item}}".
 *
 * @property string $name
 * @property integer $type
 * @property string $description
 * @property string $rule_name
 * @property string $data
 * @property integer $created_at
 * @property integer $updated_at
 */
class AuthItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%auth_item}}';
    }

    public function behaviors()
    {
    	return [
    		'timestamp' => [
    			'class' => 'yii\behaviors\TimestampBehavior',
    			'attributes' => [
    				self::EVENT_BEFORE_UPDATE => ['updated_at'],
    				self::EVENT_BEFORE_INSERT => ['created_at'],
    			],
    		],
    	];
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
        	['name', 'unique'],
        	['name', 'match', 'pattern' => '/^[\w-]+$/'],
            [['type', 'created_at', 'updated_at'], 'integer'],
            [['description', 'data'], 'string'],
            [['name', 'rule_name'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => '用户组英文',
            'type' => 'Type',
            'description' => '用户组名称',
            'rule_name' => 'Rule Name',
            'data' => 'Data',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
