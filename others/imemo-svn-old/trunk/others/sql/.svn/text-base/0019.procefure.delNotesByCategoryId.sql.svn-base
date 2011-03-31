
DELIMITER $$

DROP PROCEDURE IF EXISTS `lds0019`.`delNotesByCategoryId`$$
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

