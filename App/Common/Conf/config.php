<?php
return array(
	'DB_TYPE'   => 'mysql', // 数据库类型
	'DB_HOST'   => '127.0.0.1', // 服务器地址
	'DB_NAME'   => 'jiyexiang', // 数据库名
	'DB_USER'   => 'root', // 用户名
	'DB_PWD'    => '', // 密码
	'DB_PORT'   => 3306, // 端口
	'DB_PARAMS' =>  array(), // 数据库连接参数
	'DB_PREFIX' => 'jyx_', // 数据库表前缀 
	'DB_CHARSET'=> 'utf8', // 字符集
	'DB_FIELDS_CACHE' => TRUE,//开启缓存
	//路由设置
	//伪静态
	//'URL_HTML_SUFFIX'=>'jyx',
	//'URL_MODEL'=>2,
	//'MODULE_ALLOW_LIST'=> array('Admin','Home'),
	//'DEFAULT_MODULE'=>'Home',
	// 'URL_ROUTE_RULES'=>array(
	// 	'c'=>'Count/index',
	// 	),
	//自定义跳转页面 
	'TMPL_ACTION_SUCCESS'=>'Public:dispatch_jump',
	'TMPL_ACTION_ERROR'=>'Public:dispatch_jump',

	'SHOW_PAGE_TRACE'       => true, //开启调试,上线后删除

	'DB_DEBUG'  =>  TRUE, // 数据库调试模式 开启后可以记录SQL日志
	'AUTH_CONFIG'           => array(
    'AUTH_ON'           => true,  // 认证开关
    'AUTH_TYPE'         => 1, // 认证方式，1为实时认证；2为登录认证。
    'AUTH_GROUP'        => 'jyx_auth_group', // 用户组数据表名
    'AUTH_GROUP_ACCESS' => 'jyx_auth_group_access', // 用户-用户组关系表
    'AUTH_RULE'         => 'jyx_auth_rule', // 权限规则表
    'AUTH_USER'         => 'jyx_user', // 用户信息表
    ),


   //邮箱配置
    'MAIL_ADDRESS'=>'15927002872@163.com', // 邮箱地址
	'MAIL_SMTP'=>'smtp.163.com', // 邮箱SMTP服务器
	'MAIL_LOGINNAME'=>'15927002872@163.com', // 邮箱登录帐号
	'MAIL_PASSWORD'=>'linhua123', // 邮箱密码
	'MAIL_CHARSET'=>'UTF-8',//编码
	'MAIL_AUTH'=>true,//邮箱认证
	'MAIL_HTML'=>true,//true HTML格式 false TXT格式
);
?>
