<?php
/**
 * Created by PhpStorm.
 * User: ruanxinwu
 * Date: 2019/4/12
 * Time: 18:50
 */

namespace app\modules\user\controllers;


use app\library\Encrypt;
use app\models\LoginForm;
use yii\web\Controller;
use Yii;
class UserController extends Controller
{
    public function actionIndex()
    {
        echo 'ruanxinwu' . 'sdddd' . 'sdsdddd  ';
    }

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function actionLogin()
    {

    }

    public function actionLogOut()
    {
        pd_var(\Yii::$app->user->logout());
    }
}