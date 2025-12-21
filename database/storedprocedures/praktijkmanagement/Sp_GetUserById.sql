USE breezedemo;

DROP PROCEDURE IF EXISTS sp_GetUserById;

DELIMITER $$

CREATE PROCEDURE sp_GetUserById(
    IN p_Id INTEGER
)
BEGIN
    SELECT USRS.Id
          ,USRS.name
          ,USRS.email
          ,USRS.email_verified_at
          ,USRS.rolename
          ,USRS.created_at
          ,USRS.updated_at
    FROM Users as USRS
    WHERE USRS.id = p_Id;
END$$

DELIMITER ;
