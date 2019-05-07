<?php
namespace app\modules\user\services;

use yii\web\Controller;
use yii\web\Cookie;

class TestService //extends Controller
{
    public $key = 'nvqlemxzicu';
    public $v = 'abcdefghijklmnopqrstul';
    public static function renderJs(array $params = []): string
    {
        $html = '';
        if (empty($params)) return $html;
        foreach ($params as $param) {
            $html .= "<script type='text/javascript' src='" . \Yii::$app->params['staticHost'] . $param . "?t=".time()."&v=" . rand(10000, 99999) . "'></script>";
        }
        echo htmlentities($html);
        return '233';
    }

    public static function getRandomString($length, $isUpper = false)
    {
        $hash  = '';
        $chars = '123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXZY';

        if ($isUpper === true) {
            $chars = '123456789ABCDEFGHIJKLMNPQRSTUVWXZY';
        }

        $max = strlen($chars) - 1;
        for ($i = 0; $i < $length; $i++) {
            $hash .= $chars[mt_rand(0, $max)];
        }
        return $hash;
    }
    /**
     * des 加密
     * @param string $str
     * @return string
     */
    public function desEncrypt($str)
    {
        $encrypted = openssl_encrypt($str, 'aes-256-cbc', base64_decode($this->key), OPENSSL_RAW_DATA, base64_decode($this->v));
        return base64_encode($encrypted);
    }

    /**
     * des 解密
     * @param string $str
     * @return string
     */
    public function desDecrypt($str)
    {
        return openssl_decrypt(base64_decode($str), 'aes-256-cbc', base64_decode($this->key), OPENSSL_RAW_DATA, base64_decode($this->v));
    }
    public static function formatMapQuery($data)
    {
        $list = [];
        reset($data);
        while ($value = next($data)) {
            $list[prev($data)] = $value;
            next($data);
            next($data);
        }
        return $list;
    }

    public static function createTokenStr()
    {
        $str = md5(uniqid(md5(microtime(true)), true));
        $str = sha1($str);  //加密
        return $str;
    }

    public static function tranMenuTitle($item,$themeName,$title)
    {
        $array = json_decode($item,true);
        if (json_last_error() != JSON_ERROR_NONE || empty($array)) {
            return $array;
        }

        foreach ($array as $key => &$value){
            if ($value['type'] == 'footer') {
                $value['footmenu']['source'] = json_encode(self::setKey($value['footmenu']['source'],$title));
                if ($themeName == 'sail002'){
                    foreach($value['footmenu']['source_new'] ?? [] as $a => $b){
                        $value['footmenu']['source_new'][$a]['menu_name'] = json_encode(self::setKey($value['footmenu']['source_new'][$a]['menu_name'],$title));
                    }
                }

            }
        }
        return ($array);
    }

    public static function setKey($string, $setKey, $delimiter = ','){
        $result = array();
        if (empty($string)){
            return $result;
        }
        $codes = explode(',',trim($string,$delimiter));
        foreach ($codes as $key => $value){
            $result[] = [$setKey => $value];
        }
        return $result;
    }

    public static function strToArr($string, $delimiter = ',')
    {
        if (!is_string($string)) {

            return [];
        }

        if (empty($string)) {

            return [];
        }

        try {
            $arr = explode($delimiter, $string);
        } catch (\Exception $e) {

            return [];
        }

        if (isset($arr[0]) && empty($arr[0])) {

            return [];
        }

        return $arr;
    }

    public static function setCookie()
    {
        $cookie = new Cookie([
            'name' => 'ruanss',
            'expire' => time() + 3600,
            'httpOnly' => true,
            'value' => 'cookie_value',
            //'domain' => '.jh.com'
        ]);
        \Yii::$app->response->cookies->add($cookie);
    }

    public static function getTradeNo()
    {
        list($usec,) = explode(" ", microtime());

        $usec = substr(str_replace('0.', '', $usec), 0, 4);
        $str  = rand(10, 99);
        return date("YmdHi") . $usec . $str;
    }
    public static function random()
    {
        pd(3,\Yii::$app->request->getHostName());
        $ps = [
            'a' => 0.1,
            'b' => 0.2,
            'c' => 0.2,
            'e' => 0.5,
        ];

        static $arr = [];
        $key = md5(serialize($ps));
        if (!isset($arr[$key])) {
            $max = array_sum($ps);
            foreach ($ps as $k => $v) {
                $v = $v / $max * 10000;
                for ($i = 0; $i < $v; $i++) $arr[$key][] = $k;
            }
        }
        $num = $arr[$key][mt_rand(0, count($arr[$key]) - 1)];

        switch ($num) {
            case 'a':
                return mt_rand(1, 10);
                break;
            case 'b':
                return mt_rand(11, 20);
                break;
            case 'c':
                return mt_rand(21, 39);
                break;
            case 'e':
            default:
                return 40;
                break;
        }
    }
}
