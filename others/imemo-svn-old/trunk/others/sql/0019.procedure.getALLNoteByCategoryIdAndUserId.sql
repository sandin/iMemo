
DELIMITER $$

DROP PROCEDURE IF EXISTS `lds0019`.`getAllNoteByCategoryIdAndUserId`$$
CREATE PROCEDURE `lds0019`.`getAllNoteByCategoryIdAndUserId` (IN category_id BIGINT,IN user_id BIGINT)
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

