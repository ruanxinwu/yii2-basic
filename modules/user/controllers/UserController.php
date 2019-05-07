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
        echo 'ruanx3inwu';
    }

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function actionLogin()
    {
        $dems = 233;
        pd($dems);
       //pd_var(\Yii::$app->user->isGuest);
        $model                      = new LoginForm();
        $params                     = [];
        $params[$model->formName()]['email'] = \Yii::$app->request->post('name', '');
        $params[$model->formName()]['pwd'] = \Yii::$app->request->post('passwd', '');
        if ($model->load($params) && $model->login()){
            pd_var(1,\Yii::$app->user->isGuest);
        }

        pd('login fail');
    }

    public function actionLogOut()
    {
        pd_var(\Yii::$app->user->logout());
    }
}