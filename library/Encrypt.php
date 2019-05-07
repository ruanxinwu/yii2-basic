<?php

namespace app\library;

/**
 * 加密解密算法
 */
class Encrypt
{
    private $key = '';
    private $iv = '';
    public function __construct()
    {
        $this->key = 'nvqlemxzicu';
        $this->iv = 'abcdefghijklmnopqrstul';
    }

    /**
     * @param $key
     * @return $this
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @param $str
     * @return mixed
     */
    public function desEncrypt($str)
    {
        $encrypted = openssl_encrypt($str, 'aes-256-cbc', base64_decode($this->key), OPENSSL_RAW_DATA, base64_decode($this->iv));
        $encrypted = base64_encode($encrypted);
        return str_replace(["+", "="], ["|", ""], $encrypted);
    }

    /**
     * des 解密
     * @param string $str
     * @return string
     */
    public function desDecrypt($str)
    {
        //$str = str_replace(["|"], ["+"], $str);
        return openssl_decrypt(base64_decode($str), 'aes-256-cbc', base64_decode($this->key), OPENSSL_RAW_DATA, base64_decode($this->iv));
    }
}