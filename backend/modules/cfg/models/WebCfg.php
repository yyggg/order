<?php

namespace app\modules\cfg\models;

use Yii;

/**
 * This is the model class for table "{{%web_cfg}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $value
 */
class WebCfg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%web_cfg}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'value'], 'required'],
            ['name', 'string', 'max' => 90],
            [['name'], 'unique'],
            ['value', 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'value' => Yii::t('app', 'Value'),
        ];
    }
}
