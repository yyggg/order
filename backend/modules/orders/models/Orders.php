<?php
/**
 * Created by 260101081@qq.com
 * User: carl
 * Date: 16/12/15 下午12:33
 */

namespace app\modules\orders\models;

use app\modules\staff\models\Staff;
use backend\modules\service\models\ServiceCategory;
use Yii;

/**
 * Class Orders
 * @package app\modules\orders\models
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $teacher_name;
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
            [['site','address','size','order_no','amount','number','shop_name','status','remark','wuliu_no','refund_address','admin_remark'], 'safe'],
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
            'site' => Yii::t('app', '商品网站'),
            'address' => Yii::t('app', '地址'),
            'refund_address' => Yii::t('app', '退款地址'),
            'wuliu_no' => Yii::t('app', '物流单号'),
            'size' => Yii::t('app', '尺码'),
            'order_no' => Yii::t('app', '订单号'),
            'amount' => Yii::t('app', '支付金额'),
            'number' => Yii::t('app', '购买数量'),
            'shop_name' => Yii::t('app', '店铺名称'),
            'status' => Yii::t('app', '订单状态'),
            'remark' => Yii::t('app', '买家留言'),
            'admin_remark' => Yii::t('app', '备注'),
            'created_at' => Yii::t('app', '创建时间'),
        ];
    }
}
