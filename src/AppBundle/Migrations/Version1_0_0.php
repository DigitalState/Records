<?php

namespace AppBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Class Version1_0_0
 */
class Version1_0_0 extends AbstractMigration
{
    /**
     * Up
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    public function up(Schema $schema)
    {
        // Tables
        $this->addSql('CREATE TABLE ds_session (id VARCHAR(128) NOT NULL PRIMARY KEY, `data` BLOB NOT NULL, `time` INTEGER UNSIGNED NOT NULL, lifetime MEDIUMINT NOT NULL) COLLATE utf8_bin, engine = innodb');
        $this->addSql('CREATE TABLE ds_config (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', `key` VARCHAR(255) NOT NULL, `value` LONGTEXT DEFAULT NULL, enabled TINYINT(1) NOT NULL, version INT DEFAULT 1 NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_758C45F4D17F50A6 (uuid), UNIQUE INDEX UNIQ_758C45F44E645A7E (`key`), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ds_access (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', identity VARCHAR(255) DEFAULT NULL, identity_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', version INT DEFAULT 1 NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_A76F41DCD17F50A6 (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ds_access_permission (id INT AUTO_INCREMENT NOT NULL, access_id INT DEFAULT NULL, entity VARCHAR(255) DEFAULT NULL, entity_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', `key` VARCHAR(255) NOT NULL, attributes LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', INDEX IDX_D46DD4D04FEA67CF (access_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_record (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) DEFAULT NULL, owner_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', identity VARCHAR(255) DEFAULT NULL, identity_uuid CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', data LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', version INT DEFAULT 1 NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_7E37F211D17F50A6 (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_record_association (id INT AUTO_INCREMENT NOT NULL, record_id INT DEFAULT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', entity VARCHAR(255) NOT NULL, entity_uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', `owner` VARCHAR(255) NOT NULL, owner_uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', version INT DEFAULT 1 NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_57646D0AD17F50A6 (uuid), INDEX IDX_57646D0A4DFD750C (record_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_record_trans (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_33F4A5602C2AC5D3 (translatable_id), UNIQUE INDEX app_record_trans_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');

        // Foreign Keys
        $this->addSql('ALTER TABLE ds_access_permission ADD CONSTRAINT FK_D46DD4D04FEA67CF FOREIGN KEY (access_id) REFERENCES ds_access (id)');
        $this->addSql('ALTER TABLE app_record_association ADD CONSTRAINT FK_57646D0A4DFD750C FOREIGN KEY (record_id) REFERENCES app_record (id)');
        $this->addSql('ALTER TABLE app_record_trans ADD CONSTRAINT FK_33F4A5602C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_record (id) ON DELETE CASCADE');

        // Data
    }

    /**
     * Down
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    public function down(Schema $schema)
    {
        // Foreign Keys
        $this->addSql('ALTER TABLE ds_access_permission DROP FOREIGN KEY FK_D46DD4D04FEA67CF');
        $this->addSql('ALTER TABLE app_record_association DROP FOREIGN KEY FK_57646D0A4DFD750C');
        $this->addSql('ALTER TABLE app_record_trans DROP FOREIGN KEY FK_33F4A5602C2AC5D3');

        // Tables
        $this->addSql('DROP TABLE ds_config');
        $this->addSql('DROP TABLE ds_access');
        $this->addSql('DROP TABLE ds_access_permission');
        $this->addSql('DROP TABLE app_record');
        $this->addSql('DROP TABLE app_record_association');
        $this->addSql('DROP TABLE app_record_trans');
        $this->addSql('DROP TABLE ds_session');
    }
}
