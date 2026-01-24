-- Create userroles table
USE breezedemo;

CREATE TABLE IF NOT EXISTS userroles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    rolename VARCHAR(50) NOT NULL UNIQUE,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);

-- Insert the roles
INSERT INTO userroles (rolename) VALUES 
('manager'),
('patient'),
('praktijkmanagement')
ON DUPLICATE KEY UPDATE rolename = VALUES(rolename);

-- Show result
SELECT * FROM userroles;
