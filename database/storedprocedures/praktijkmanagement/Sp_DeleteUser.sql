USE breezedemo;

DELIMITER $$

DROP PROCEDURE IF EXISTS sp_DeleteUser$$

CREATE PROCEDURE sp_DeleteUser(
    IN p_id INT
)
BEGIN
    DELETE FROM users
    WHERE Id = p_id;
    
    SELECT ROW_COUNT() AS affected;
END$$

DELIMITER ;
