<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/12/15 下午12:33
 */

namespace app\modules\orders\models;

use Yii;

/**
 * This is the model class for table "{{%orders}}".
 *
 * @property integer $id
 * @property integer $student_id
 * @property string $student_name
 * @property integer $product_id
 * @property string $product_name
 * @property integer $stime
 * @property integer $etime
 * @property string $money
 * @property string $payment_type
 * @property string $principal
 * @property string $remark
 * @property integer $created_at
 */
class OrdersAtv extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%orders}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['patriarch_name','product_name','phone','product_id','stime','etime'], 'required'],
            [['product_id', 'category_id','created_at'], 'integer'],
            [['money'], 'number'],
            [['patriarch_name', 'principal'], 'string', 'max' => 12],
            [['product_name'], 'string', 'max' => 90],
            [['payment_type'], 'string', 'max' => 9],
            [['phone'], 'string', 'max' => 11],
            [['remark'], 'string', 'max' => 300],
            ['created_at', 'default', 'value' => time()]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', '服务项目ID'),
            'product_name' => Yii::t('app', '服务项目'),
            'patriarch_name' => Yii::t('app', '客户姓名'),
            'phone' => Yii::t('app', '客户电话'),
            'stime' => Yii::t('app', '开始日期'),
            'etime' => Yii::t('app', '结束日期'),
            'money' => Yii::t('app', '金额'),
            'payment_type' => Yii::t('app', '支付方式'),
            'principal' => Yii::t('app', '操作员'),
            'remark' => Yii::t('app', '备注'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
