<?php
/**
 * JnsSign.php
 * @author qjy 2022/5/24
 * @update qjy 2022/5/24
 */

namespace cayu\libsign;

use \cayu\libsign\contracts\Sign;

class JnsSign implements Sign
{
    private static $instance;
    
    /**
     * 禁止克隆
     *
     * @create 2020-8-12
     * @author cayu
     */
    public function __construct()
    {
    }
    
    /**
     * 禁止克隆
     *
     * @create 2020-8-12
     * @author cayu
     */
    public function __clone()
    {
    
    }
    
    /**
     * 单例
     *
     * @create 2020-8-12
     * @author cayu
     */
    public static function getInstance()
    {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self();
        }
        
        return self::$instance;
    }
    
    
    /**
     * 生成内容签名
     * @param $data
     * @return string
     *
     * @create 2020-8-12
     * @author cayu
     */
    public function makeSign($data, $key = '')
    {
        $string = md5($this->makeSignContent($data).'&key='.$key);
        return strtoupper($string);
    }
    
    
    /**
     * 生成签名内容
     * @param $data
     * @return string
     *
     * @create 2020-8-12
     * @author cayu
     */
    public function makeSignContent($data)
    {
        $buff = '';
        ksort($data);
        foreach($data as $key => $val)
        {
            if($val === '' || $key =='sign'){ // 空项不参与签名生成
                unset($data[$key]);
                continue;
            }
            if(is_array($val)){
                $val = json_encode($val,JSON_UNESCAPED_UNICODE);
            }
            $buff .= $key.'='.trim($val).'&';
        }
        return trim($buff,'&');
    }
    
    public function createNonceStr($length = 16){
    
    }
}