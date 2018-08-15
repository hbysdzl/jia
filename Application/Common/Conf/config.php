<?php
return array(
	//'配置项'=>'配置值'

	
    /* 数据库设置 */
    'DB_TYPE'               =>  'mysqli',     // 数据库类型
    'DB_HOST'               =>  '127.0.0.1', // 服务器地址
    'DB_NAME'               =>  'jia',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'root',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'jia_',    // 数据库表前缀
    'DB_PARAMS'          	=>  array(), // 数据库连接参数
    'DB_DEBUG'  			=>  TRUE, // 数据库调试模式 开启后可以记录SQL日志
    'DB_FIELDS_CACHE'       =>  false,        // 启用字段缓存
    'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8  
    
    //密码加密配置
    'MD5_PSW'               =>'kjgujalureyrt213wekyuol12TU',
    
    //配置标题
    'TITLE'                 =>'家造网',
    //密码加密配置
    'MD5_PSW'               =>'kjgujalureyrt213wekyuol12TU',
    
    'IMG_PATH'              =>'/Public/Upload',//存放上传文件的目录

    'IMG_ROOTPATH'          =>'./Public/Upload/', //硬盘图片路径

    //模板布局配置
    'TMPL_LAYOUT_ITEM'      =>  '{__CONTENT__}', // 布局模板的内容替换标识
    'LAYOUT_ON'             =>  false, // 是否启用布局
    'LAYOUT_NAME'           =>  'layout', // 当前布局名称 默认为layout
);