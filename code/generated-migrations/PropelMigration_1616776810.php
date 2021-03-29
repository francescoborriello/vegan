<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1616776810.
 * Generated on 2021-03-26 16:40:10 by root
 */
class PropelMigration_1616776810
{
    public $comment = '';

    public function preUp(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postUp(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    public function preDown(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postDown(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        return array (
  'default' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `author`;

ALTER TABLE `book` DROP FOREIGN KEY `book_fk_ea464c`;

DROP INDEX `book_fi_ea464c` ON `book`;

ALTER TABLE `book`

  CHANGE `title` `filename` VARCHAR(255) NOT NULL,

  ADD `path` VARCHAR(255) NOT NULL AFTER `filename`,

  DROP `isbn`,

  DROP `author_id`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        return array (
  'default' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `book`

  CHANGE `filename` `title` VARCHAR(255) NOT NULL,

  ADD `isbn` VARCHAR(24) NOT NULL AFTER `title`,

  ADD `author_id` INTEGER NOT NULL AFTER `isbn`,

  DROP `path`;

CREATE INDEX `book_fi_ea464c` ON `book` (`author_id`);

ALTER TABLE `book` ADD CONSTRAINT `book_fk_ea464c`
    FOREIGN KEY (`author_id`)
    REFERENCES `author` (`id`);

CREATE TABLE `author`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `first_name` VARCHAR(128) NOT NULL,
    `last_name` VARCHAR(128) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}