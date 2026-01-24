-- Run this in MySQL Workbench to check your manager account
USE jamin_db;

-- Check what your account looks like
SELECT id, name, email, rolename FROM users WHERE email LIKE '%manager%';

-- If the rolename is not exactly 'manager', update it:
UPDATE users SET rolename = 'manager' WHERE email = 'manager@jamil.nl';
