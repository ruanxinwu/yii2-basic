<?php
/**
 * Created by PhpStorm.
 * User: ruanxinwu
 * Date: 2019/3/29
 * Time: 12:35
 */
namespace app\components;
class AppErrorHandler extends \yii\web\ErrorHandler
{
    public function handleException($exception)
    {
        pd(33333333);
    }
}