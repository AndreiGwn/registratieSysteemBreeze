USE breezedemo;

DROP PROCEDURE IF EXISTS sp_GetAllUsers;

DELIMITER $$

CREATE PROCEDURE sp_GetAllUsers(
    IN user_Id INT
)
BEGIN
    SELECT 
        id,
        name,
        email,
        rolename,
        created_at,
        updated_at
    FROM 
        users
    ORDER BY 
        id ASC;
END$$

DELIMITER ;
