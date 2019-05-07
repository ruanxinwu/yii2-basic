<?php
/**
 * Created by PhpStorm.
 * User: ruanxinwu
 * Date: 2019/3/7
 * Time: 9:11
 */

namespace app\modules\user\controllers;

use yii\web\Controller;
class TestController extends Controller
{
    public function actionTest()
    {
        echo '23233';
        pd(\Yii::$app->request->get());
    }
}