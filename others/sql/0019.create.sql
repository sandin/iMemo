drop  database if exists lds0019;
create database lds0019;
use lds0019;

DROP TABLE IF EXISTS `lds0019_users`;
create table lds0019_users (
  user_id		serial		  not null,
  username		varchar(255)  not null,
  password		varchar(32)	  not null,
  ts_created    varchar(10)      not null,
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


