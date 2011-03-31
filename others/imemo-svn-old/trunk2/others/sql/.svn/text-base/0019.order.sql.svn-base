use lds0019;

DROP TABLE IF EXISTS `lds0019_notes_order`;
create table lds0019_notes_order (
  order_id		serial		            not null,
  note_id		bigint(20) unsigned 	not null,
  fronthand		bigint(20) unsigned 	DEFAULT NULL,
  backhand		bigint(20) unsigned 	DEFAULT NULL,

  primary key (order_id),
  index(note_id)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
