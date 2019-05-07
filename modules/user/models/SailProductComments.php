<?php
/**
 * Created by PhpStorm.
 * User: ruanxinwu
 * Date: 2019/3/29
 * Time: 16:25
 */
namespace app\modules\user\models;
use yii\db\ActiveRecord;

class SailProductComments extends ActiveRecord
{
    public static function tableName()
    {
        return 'sail_product_comments';
    }
}