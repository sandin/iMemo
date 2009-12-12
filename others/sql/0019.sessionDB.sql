   --  
   -- 表的结构 `sessions`  
   --  
   CREATE TABLE IF NOT EXISTS `lds0019_sessions` (  
	`id` char(32) collate utf8_unicode_ci NOT NULL,  
	`modified` int(10) NOT NULL,  
	`lifetime` int(10) NOT NULL,  
	`data` text collate utf8_unicode_ci NOT NULL,  
	PRIMARY KEY  (`id`)  
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;  
