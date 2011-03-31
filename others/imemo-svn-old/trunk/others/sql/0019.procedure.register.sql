
DELIMITER $$

DROP PROCEDURE IF EXISTS `lds0019`.`register`$$
CREATE PROCEDURE `lds0019`.`register` (IN user_id BIGINT)
BEGIN

INSERT INTO lds0019_users_link_categorys VALUE(null,user_id,1);
INSERT INTO lds0019_users_link_categorys VALUE(null,user_id,2);
INSERT INTO lds0019_users_link_categorys VALUE(null,user_id,3);
INSERT INTO lds0019_users_link_categorys VALUE(null,user_id,4);
INSERT INTO lds0019_users_link_categorys VALUE(null,user_id,5);
INSERT INTO lds0019_users_link_categorys VALUE(null,user_id,6);


END$$

DELIMITER ;

