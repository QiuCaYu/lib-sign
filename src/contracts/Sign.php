<?php
/**
 * Sign.php
 * @author qjy 2022/5/24
 * @update qjy 2022/5/24
 */

namespace cayu\libsign\contracts;

interface Sign
{
    public function __construct();
    
    public function __clone();
    
    public static function getInstance();
    
    public function makeSign($data, $key = '');
    
    public function makeSignContent($data);
    
    public function createNonceStr($length = 16);
}