use wupinping_eriji;

DROP TABLE IF EXISTS `lds0019_users`;
create table lds0019_users (
  user_id		serial		  not null,
  username		varchar(255)  not null,
  password		varchar(32)	  not null,
  safecode		varchar(32)	  not null,
  ts_created    varchar(10)   not null,
  ts_last_login	varchar(10),

  primary key (user_id),
  unique(username)	
)  AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `lds0019_notes`;
create table lds0019_notes (
  note_id		serial		            not null,
  user_id		bigint(20) unsigned 	not null,
  dueDate		varchar(10),
  style			varchar(255),
  star			int(5)			DEFAULT 0,	  
  ts_created    varchar(10)      not null,

  primary key (note_id),
  FOREIGN KEY (user_id) REFERENCES lds0019_users(user_id)
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `lds0019_notes_categorys`;
create table lds0019_notes_categorys (
  category_id		serial					not null,
  category_name		varchar(255)			not null,
  ts_created	    varchar(10)			    not null,

  primary key (category_id)
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `lds0019_users_link_categorys`;
create table lds0019_users_link_categorys (
  link_id	        serial				    not null,
  user_id			bigint(20) unsigned 	not null,
  category_id		bigint(20) unsigned 	not null,

  primary key (link_id),
  FOREIGN KEY (user_id) REFERENCES lds0019_users(user_id),
  FOREIGN KEY (category_id) REFERENCES lds0019_notes_categorys(category_id)
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `lds0019_notes_link_categorys`;
create table lds0019_notes_link_categorys (
  link_id		 serial				      not null,
  category_id	 bigint(20) unsigned	  not null,
  note_id		 bigint(20) unsigned	  not null,

  primary key (link_id),
  FOREIGN KEY (category_id) REFERENCES lds0019_notes_categorys(category_id),
  FOREIGN KEY (note_id) REFERENCES lds0019_notes(note_id)
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `lds0019_notes_tags`;
create table lds0019_notes_tags (
  tag_id		serial	         not null,
  tag_name		varchar(255)     not null,
  user_id		bigint(20) unsigned 	not null,
  ts_created    varchar(10)      not null,

  primary key (tag_id),
  FOREIGN KEY (user_id) REFERENCES lds0019_users(user_id)
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `lds0019_notes_link_tags`;
create table lds0019_notes_link_tags (
  link_id		serial				  not null,
  tag_id		bigint(20) unsigned	  not null,
  note_id		bigint(20) unsigned	  not null,

  FOREIGN KEY (tag_id) REFERENCES lds0019_notes_tags(tag_id),
  FOREIGN KEY (note_id) REFERENCES lds0019_notes(note_id)
) AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `lds0019_notes_content`;
create table lds0019_notes_content (
  content_id		serial	         not null,
  note_id			bigint(20) unsigned	  not null,
  content			text,
  ts_modified	    varchar(10),  

  FOREIGN KEY (note_id) REFERENCES lds0019_notes(note_id)
)  AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;



/* 创建原始数据 */
/*
INSERT INTO lds0019_users VALUE
(NULL,'lds2012@gmail.com','25d55ad283aa400af464c76d713c07ad',1261027980,NULL);
*/
INSERT INTO lds0019_notes_categorys VALUE(null,'Inbox',1261027980);
INSERT INTO lds0019_notes_categorys VALUE(null,'Today',1261027980);
INSERT INTO lds0019_notes_categorys VALUE(null,'Next',1261027980);
INSERT INTO lds0019_notes_categorys VALUE(null,'Maybe',1261027980);
INSERT INTO lds0019_notes_categorys VALUE(null,'Projects',1261027980);
INSERT INTO lds0019_notes_categorys VALUE(null,'Areas',1261027980);

INSERT INTO lds0019_users_link_categorys VALUE(null,1,1);
INSERT INTO lds0019_users_link_categorys VALUE(null,1,2);
INSERT INTO lds0019_users_link_categorys VALUE(null,1,3);
INSERT INTO lds0019_users_link_categorys VALUE(null,1,4);
INSERT INTO lds0019_users_link_categorys VALUE(null,1,5);
INSERT INTO lds0019_users_link_categorys VALUE(null,1,6);


DROP TABLE IF EXISTS `lds0019_notes_order`;
create table lds0019_notes_order (
  order_id		serial		            not null,
  note_id		bigint(20) unsigned 	not null,
  fronthand		bigint(20) unsigned 	DEFAULT NULL,
  backhand		bigint(20) unsigned 	DEFAULT NULL,

  primary key (order_id),
  index(note_id)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DELIMITER $$

DROP PROCEDURE IF EXISTS `wupinping_eriji`.`getAllNoteByCategoryIdAndUserId`$$
CREATE PROCEDURE `wupinping_eriji`.`getAllNoteByCategoryIdAndUserId` (IN category_id BIGINT,IN user_id BIGINT)
BEGIN

SELECT 
notes.note_id,
notes.user_id,
notes.dueDate,
notes.style,
notes.star,
notes.ts_created,
group_concat(tags.tag_id) AS tags_id,
group_concat(tags.tag_name) AS tags_name,
cate.category_id AS categorys_id,
cate.category_name AS categorys_name,
content.content_id,
content.content,
orders.fronthand,
orders.backhand

FROM lds0019_notes AS notes 

LEFT JOIN lds0019_notes_order AS orders 
ON notes.note_id=orders.note_id

LEFT JOIN lds0019_notes_content AS content 
ON notes.note_id=content.note_id

LEFT JOIN lds0019_notes_link_tags AS ln_tags
ON notes.note_id=ln_tags.note_id

LEFT JOIN lds0019_notes_tags AS tags
ON ln_tags.tag_id=tags.tag_id

LEFT JOIN lds0019_notes_link_categorys AS ln_cate
ON notes.note_id=ln_cate.note_id

LEFT JOIN lds0019_notes_categorys AS cate
ON ln_cate.category_id=cate.category_id

WHERE cate.category_id=category_id
AND notes.user_id=user_id
GROUP BY notes.note_id

;
END$$

DELIMITER ;


DELIMITER $$

DROP PROCEDURE IF EXISTS `wupinping_eriji`.`getAllNoteByUserId`$$
CREATE PROCEDURE `wupinping_eriji`.`getAllNoteByUserId` (IN user_id BIGINT)
BEGIN

SELECT 
notes.note_id,
notes.user_id,
notes.dueDate,
notes.style,
notes.star,
notes.ts_created,
group_concat(tags.tag_id) AS tags_id,
group_concat(tags.tag_name) AS tags_name,
group_concat(cate.category_id) AS categorys_id,
group_concat(cate.category_name) AS categorys_name,
content.content_id,
content.content

FROM lds0019_notes AS notes 

LEFT JOIN lds0019_notes_content AS content 
ON notes.note_id=content.note_id

LEFT JOIN lds0019_notes_link_tags AS ln_tags
ON notes.note_id=ln_tags.note_id

LEFT JOIN lds0019_notes_tags AS tags
ON ln_tags.tag_id=tags.tag_id

LEFT JOIN lds0019_notes_link_categorys AS ln_cate
ON notes.note_id=ln_cate.note_id

LEFT JOIN lds0019_notes_categorys AS cate
ON ln_cate.category_id=cate.category_id

WHERE notes.user_id=user_id
GROUP BY notes.note_id

;
END$$

DELIMITER ;


DELIMITER $$

DROP PROCEDURE IF EXISTS `wupinping_eriji`.`getMyCategorysByUserId`$$
CREATE PROCEDURE `wupinping_eriji`.`getMyCategorysByUserId` (IN user_id BIGINT)
BEGIN

SELECT cate.category_id, cate.category_name
FROM lds0019_notes_categorys AS cate

LEFT JOIN lds0019_users_link_categorys AS ln_cate 
ON cate.category_id=ln_cate.category_id

WHERE	ln_cate.user_id=user_id
GROUP BY category_id
LIMIT 0,1000

;
END$$

DELIMITER ;


DELIMITER $$

DROP PROCEDURE IF EXISTS `wupinping_eriji`.`getAllNoteByUserId`$$
CREATE PROCEDURE `wupinping_eriji`.`getAllNoteByUserId` (IN user_id BIGINT)
BEGIN

SELECT 
notes.note_id,
notes.user_id,
notes.dueDate,
notes.style,
notes.star,
notes.ts_created,
group_concat(tags.tag_id) AS tags_id,
group_concat(tags.tag_name) AS tags_name,
group_concat(cate.category_id) AS categorys_id,
group_concat(cate.category_name) AS categorys_name,
content.content_id,
content.content

FROM lds0019_notes AS notes 

LEFT JOIN lds0019_notes_content AS content 
ON notes.note_id=content.note_id

LEFT JOIN lds0019_notes_link_tags AS ln_tags
ON notes.note_id=ln_tags.note_id

LEFT JOIN lds0019_notes_tags AS tags
ON ln_tags.tag_id=tags.tag_id

LEFT JOIN lds0019_notes_link_categorys AS ln_cate
ON notes.note_id=ln_cate.note_id

LEFT JOIN lds0019_notes_categorys AS cate
ON ln_cate.category_id=cate.category_id

WHERE notes.user_id=user_id
GROUP BY notes.note_id

;
END$$

DELIMITER ;


DELIMITER $$

DROP PROCEDURE IF EXISTS `wupinping_eriji`.`register`$$
CREATE PROCEDURE `wupinping_eriji`.`register` (IN user_id BIGINT)
BEGIN

INSERT INTO lds0019_users_link_categorys VALUE(null,user_id,1);
INSERT INTO lds0019_users_link_categorys VALUE(null,user_id,2);
INSERT INTO lds0019_users_link_categorys VALUE(null,user_id,3);
INSERT INTO lds0019_users_link_categorys VALUE(null,user_id,4);
INSERT INTO lds0019_users_link_categorys VALUE(null,user_id,5);
INSERT INTO lds0019_users_link_categorys VALUE(null,user_id,6);


END$$

DELIMITER ;


DELIMITER $$

DROP PROCEDURE IF EXISTS `wupinping_eriji`.`delNotesByCategoryId`$$
CREATE DEFINER=`lds`@`localhost` PROCEDURE `delNotesByCategoryId`(IN category_id BIGINT)
BEGIN

DELETE notes.*, content.*
FROM lds0019_notes AS notes 

LEFT JOIN lds0019_notes_content AS content 
ON notes.note_id=content.note_id

LEFT JOIN lds0019_notes_link_tags AS ln_tags
ON notes.note_id=ln_tags.note_id

LEFT JOIN lds0019_notes_tags AS tags
ON ln_tags.tag_id=tags.tag_id

LEFT JOIN lds0019_notes_link_categorys AS ln_cate
ON notes.note_id=ln_cate.note_id

LEFT JOIN lds0019_notes_categorys AS cate
ON ln_cate.category_id=cate.category_id

WHERE ln_cate.category_id=category_id

;
END$$


   CREATE TABLE IF NOT EXISTS `lds0019_sessions` (  
	`id` char(32) collate utf8_unicode_ci NOT NULL,  
	`modified` int(10) NOT NULL,  
	`lifetime` int(10) NOT NULL,  
	`data` text collate utf8_unicode_ci NOT NULL,  
	PRIMARY KEY  (`id`)  
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;  

