
DELIMITER $$

DROP PROCEDURE IF EXISTS `lds0019`.`getMyCategorysByUserId`$$
CREATE PROCEDURE `lds0019`.`getMyCategorysByUserId` (IN user_id BIGINT)
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

