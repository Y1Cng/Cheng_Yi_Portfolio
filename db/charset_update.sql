-- Change database and tables to utf8mb4_general_ci
-- Database: y1cng118_portfolio

USE y1cng118_portfolio;

-- Change database character set
ALTER DATABASE y1cng118_portfolio CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- Change admin table
ALTER TABLE admin CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- Change message table
ALTER TABLE message CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- Change project table
ALTER TABLE project CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;