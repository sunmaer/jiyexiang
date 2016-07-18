-- 表的结构：jyx_admin --
CREATE TABLE `jyx_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `time` timestamp NOT NULL,
  `status` tinyint(1) NOT NULL,
  `admin` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;-- <xjx> --

-- 表的结构：jyx_auth_group --
CREATE TABLE `jyx_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` char(80) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;-- <xjx> --

-- 表的结构：jyx_auth_group_access --
CREATE TABLE `jyx_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;-- <xjx> --

-- 表的结构：jyx_auth_rule --
CREATE TABLE `jyx_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;-- <xjx> --

-- 表的结构：jyx_count --
CREATE TABLE `jyx_count` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `height` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `depth` int(11) NOT NULL,
  `box_depth` double NOT NULL,
  `door_depth` double NOT NULL,
  `block_depth` double NOT NULL,
  `locktype` varchar(20) NOT NULL,
  `color` varchar(20) NOT NULL,
  `xianjia` varchar(10) NOT NULL,
  `mft_type` varchar(10) NOT NULL,
  `unit_price` double NOT NULL,
  `count` int(11) NOT NULL,
  `total` double NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;-- <xjx> --

-- 表的结构：jyx_formulate --
CREATE TABLE `jyx_formulate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `formulate` varchar(300) NOT NULL COMMENT '计算式',
  `name` varchar(40) NOT NULL COMMENT '计算式名称',
  `status` tinyint(1) NOT NULL COMMENT '使用状态',
  `judge` tinyint(1) NOT NULL COMMENT '是否需要判定',
  `corder` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;-- <xjx> --

-- 表的结构：jyx_judge --
CREATE TABLE `jyx_judge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '公式id',
  `op` varchar(6) NOT NULL COMMENT '比较符号',
  `contion` varchar(10) NOT NULL COMMENT '比较条件',
  `result` varchar(10) NOT NULL COMMENT '比价结果',
  `item` varchar(10) NOT NULL COMMENT '判定项',
  `judgename` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;-- <xjx> --

-- 表的结构：jyx_nojudge --
CREATE TABLE `jyx_nojudge` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL COMMENT '公式id',
  `name` varchar(12) NOT NULL COMMENT '对应名称',
  `value` varchar(12) NOT NULL COMMENT '对应值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;-- <xjx> --

-- 表的结构：jyx_other_material --
CREATE TABLE `jyx_other_material` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `materialprice` double NOT NULL COMMENT '材料单价',
  `packprice` double NOT NULL COMMENT '包装单价',
  `rentalper` double NOT NULL COMMENT '场租杂费百分比',
  `xianjia` double NOT NULL COMMENT '线夹单价',
  `areaprice` double NOT NULL COMMENT '员工每平米价格',
  `gultenprice` double NOT NULL COMMENT '强筋单价',
  `density` double NOT NULL COMMENT '密度',
  `xianjianum` int(11) NOT NULL COMMENT '线夹数量',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;-- <xjx> --

-- 表的结构：jyx_report_forms --
CREATE TABLE `jyx_report_forms` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `name` varchar(20) NOT NULL COMMENT '客户姓名',
  `selfphone` varchar(11) NOT NULL COMMENT '客户电话',
  `companyname` varchar(30) NOT NULL COMMENT '公司名',
  `type` varchar(20) NOT NULL COMMENT '型号',
  `locktype` varchar(20) NOT NULL,
  `color` varchar(10) NOT NULL,
  `height` int(11) NOT NULL COMMENT '箱高',
  `width` int(11) NOT NULL COMMENT '箱宽',
  `depth` int(11) NOT NULL COMMENT '箱深',
  `box_depth` double NOT NULL COMMENT '箱厚',
  `door_depth` double NOT NULL COMMENT '门厚',
  `block_depth` double NOT NULL COMMENT '板厚',
  `unit_price` double NOT NULL COMMENT '单价',
  `count` int(11) NOT NULL COMMENT '数量',
  `total` double NOT NULL COMMENT '总价',
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;-- <xjx> --

-- 表的结构：jyx_site --
CREATE TABLE `jyx_site` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `keywords` text NOT NULL,
  `description` text NOT NULL,
  `url` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;-- <xjx> --

-- 表的结构：jyx_user --
CREATE TABLE `jyx_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL COMMENT '注册名',
  `password` varchar(40) NOT NULL,
  `name` varchar(20) NOT NULL COMMENT '客户名称',
  `companyname` varchar(28) NOT NULL,
  `companyphone` varchar(11) NOT NULL,
  `selfphone` varchar(11) NOT NULL,
  `qq` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '能否（1,0）登陆状态',
  `address` varchar(40) NOT NULL,
  `wechat` varchar(14) NOT NULL,
  `email` varchar(20) NOT NULL,
  `time` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;-- <xjx> --

-- 表的数据：jyx_admin --
INSERT INTO `jyx_admin` VALUES
('1','admin','21232f297a57a5a743894a0e4a801fc3','2016-06-01 08:06:21','1','super'),
('2','test','72198e6593c5d19c8fec017e66fdc21e','2016-05-21 11:41:02','1','common');-- <xjx> --

-- 表的数据：jyx_auth_group --
INSERT INTO `jyx_auth_group` VALUES
('1','所有权限管理员','1','1,2,3,4,5,6'),
('2','部分权限管理员\r\n','1','1');-- <xjx> --

-- 表的数据：jyx_auth_group_access --
INSERT INTO `jyx_auth_group_access` VALUES
('2','1'),
('3','1');-- <xjx> --

-- 表的数据：jyx_auth_rule --
INSERT INTO `jyx_auth_rule` VALUES
('1','Admin/Index/index','后台首页','1','1',''),
('2','Admin/Tabexcel/index','表格导出','1','1','');-- <xjx> --

-- 表的数据：jyx_formulate --
INSERT INTO `jyx_formulate` VALUES
('1','(（箱高*箱宽+箱高*箱深*2+箱宽*箱深*2)*箱厚+箱高*箱宽*板厚+箱高*箱宽*门厚）*密度*材料单价','材料价格计算式','1','0','1'),
('2','锁数量*锁单价','锁价格计算式','1','1','2'),
('3','封条单价*（箱高+箱宽）*2','密封条价格计算式','1','1','3'),
('4','包装单价*（箱高*箱宽+箱高*箱深+箱深*箱宽）*2','包装价格计算式','1','0','4'),
('5','线夹数*单价','线夹计算式','1','0','5'),
('6','喷塑单价*（（箱高*箱宽+箱深*箱高+箱深*箱宽）*2+箱宽*箱高）','喷塑计算式','1','1','6'),
('7','箱高*数量*强筋单价','强筋价格计算式','1','1','7'),
('8','每平米单价*（（箱高*箱宽+箱深*箱高+箱深*箱宽）*2+箱高*箱宽）','人员工资计算式','1','0','8'),
('9','附件','附件价格计算式','1','1','9'),
('10','前式累加*场租比','场租费用1','1','0','10'),
('11','(箱高*箱宽*3+箱高*箱深*2+箱宽*箱深*2)*面积单价','场租费用2','0','0','10'),
('12','前式累加*利润点','利润','1','1','11'),
('13','塑粉颜色*其他','假设有塑粉颜色公式','0','1','0');-- <xjx> --

-- 表的数据：jyx_judge --
INSERT INTO `jyx_judge` VALUES
('1','2','>','600','2','箱高','锁数量'),
('2','2','>','0','1','箱高','锁数量'),
('3','3','<=','1000','3','箱高','封条单价'),
('4','3','<=','5000','5','箱高','封条单价'),
('5','6','>','1200','20','箱高,箱宽','喷塑单价'),
('6','6','>','0','16','箱高,箱宽','喷塑单价'),
('7','7','<','600','0','箱高','数量'),
('8','7','<','800','1','箱高','数量'),
('9','7','<','5000','2','箱高','数量'),
('10','9','<','500','5','箱高','附件'),
('11','9','<','1000','10','箱高','附件'),
('12','9','<','2000','20','箱高','附件'),
('14','12','=','A','0.3','类型','利润点'),
('15','12','=','B','0.3','类型','利润点'),
('16','12','=','C','0.4','类型','利润点'),
('17','12','=','D','0.2','类型','利润点'),
('19','2','=','铁锁','3','锁类型','锁单价'),
('23','2','=','其他锁','4','锁类型','锁单价'),
('26','9','<','5000','30','箱高','附件'),
('27','13','=','7035','7','塑粉颜色','塑粉颜色'),
('28','13','=','1790','888','塑粉颜色','塑粉颜色');-- <xjx> --

-- 表的数据：jyx_nojudge --
INSERT INTO `jyx_nojudge` VALUES
('1','1','密度','7931'),
('2','1','材料单价','3'),
('3','4','包装单价','3.5'),
('4','5','线夹数','2'),
('5','5','单价','1'),
('6','7','强筋单价','2'),
('7','8','每平米单价','12'),
('8','10','场租比','0.04'),
('9','11','面积单价','4');-- <xjx> --

-- 表的数据：jyx_other_material --
INSERT INTO `jyx_other_material` VALUES
('1','6','3.5','0.2','3','12','2','7930','2');-- <xjx> --

-- 表的数据：jyx_report_forms --
INSERT INTO `jyx_report_forms` VALUES
('1','41','user0','15927000000','','D','铁锁','7035','122','2222','2222','2','1','2','1185','12','14223','1467861601'),
('2','41','user0','15927000000','','D','铁锁','7035','122','2222','2222','2','1','2','1183','12','14193','1467861608'),
('3','41','user0','15927000000','','D','铁锁','7035','122','2222','2222','2','1','2','1183','12','14193','1467861610'),
('4','41','user0','15927000000','','D','铁锁','1790','122','2222','2222','2','1','2','1183','12','14193','1467861613');-- <xjx> --

-- 表的数据：jyx_site --
INSERT INTO `jyx_site` VALUES
('1','温州凡创电气科技有限公司-基业箱','基业箱 配电箱 不锈钢配电箱 照明箱','基业箱计算','localhost');-- <xjx> --

-- 表的数据：jyx_user --
INSERT INTO `jyx_user` VALUES
('41','usertest','97f3c717da19b4697ae9884e67aabce6','user0','','','15927000000','','1','','','596527851@qq.com','2016-06-01 08:06:15');-- <xjx> --

