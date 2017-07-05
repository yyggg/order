<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class ResetPasswordForm extends Model
{
    public $password;
    public $passwordok;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['passwordok', 'compare','compareAttribute'=>'password'],
        ];
    }
}
