-- Add manager role to userroles table
USE breezedemo;

-- Insert the manager role
INSERT INTO userroles (rolename) VALUES ('manager')
ON DUPLICATE KEY UPDATE rolename = 'manager';

-- Show final result
SELECT * FROM userroles ORDER BY rolename;
