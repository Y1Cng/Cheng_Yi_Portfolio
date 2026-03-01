-- Add soft delete column to project table (only if not exists)
SET @sql = (SELECT IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'project' AND COLUMN_NAME = 'is_deleted') = 0,
    'ALTER TABLE `project` ADD COLUMN `is_deleted` TINYINT(1) NOT NULL DEFAULT 0 AFTER `flag`;',
    'SELECT "Column is_deleted already exists";'
));
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Update existing data to active (is_deleted = 0)
UPDATE `project` SET `is_deleted` = 0 WHERE `is_deleted` IS NULL;