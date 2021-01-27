<?php

ini_set('display_errors', 'on');//开启或关闭PHP异常信息
date_default_timezone_set('Asia/Shanghai');
error_reporting(E_ALL);//异常级别设置

//系统设置不可替换的静态配置
define('FD_DS', DIRECTORY_SEPARATOR);//定制目录符合
define('SYS_ROOTDIR', dirname(dirname(__FILE__)) . FD_DS);

define('SYS_LOGDIR', SYS_ROOTDIR . 'Logs' . FD_DS);//日志放置区域
define('SYS_CACHE', SYS_ROOTDIR . 'App' . FD_DS . 'Cache' . FD_DS);//cache目录，smarty cache，文件缓存放置区域
define('SYS_CONTROLLER', SYS_ROOTDIR . 'App' . FD_DS . 'Http' . FD_DS);//http业务代码层
define('SYS_VIEW', SYS_ROOTDIR . 'App' . FD_DS . 'View' . FD_DS);//http业务模板层

//autoload not init tips
if(!file_exists(SYS_ROOTDIR . 'vendor/autoload.php')){
    echo "please run composer update. on project root to init.\n";
    exit;
}
//加载autoload
require_once(SYS_ROOTDIR . 'vendor/autoload.php');

/**
 * 老用户兼容使用
 * 老框架没有namespace
 * 加载后老框架所有功能可以使用
 */
//require_once('Fend/Old.php');


//设置配置，加载路径
//\Fend\Config::setConfigPath(SYS_ROOTDIR . 'tests/Config');