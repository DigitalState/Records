<?php

namespace App\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Migrations\Version;
use Ds\Component\Acl\Migration\Version0_15_0 as Acl;
use Ds\Component\Config\Migration\Version0_15_0 as Config;
use Ds\Component\Container\Attribute;
use Ds\Component\Database\Util\Objects;
use Ds\Component\Database\Util\Parameters;
use Ds\Component\Metadata\Migration\Version0_15_0 as Metadata;
use Ds\Component\Parameter\Migration\Version0_15_0 as Parameter;
use Ds\Component\Tenant\Migration\Version0_15_0 as Tenant;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * Class Version0_15_0
 */
final class Version0_15_0 extends AbstractMigration implements ContainerAwareInterface
{
    use Attribute\Container;

    /**
     * @cont string
     */
    const DIRECTORY = '/srv/api/config/migrations';

    /**
     * @var \Ds\Component\Acl\Migration\Version0_15_0
     */
    private $acl;

    /**
     * @var \Ds\Component\Config\Migration\Version0_15_0
     */
    private $config;

    /**
     * @var \Ds\Component\Metadata\Migration\Version0_15_0
     */
    private $metadata;

    /**
     * @var \Ds\Component\Parameter\Migration\Version0_15_0
     */
    private $parameter;

    /**
     * @var \Ds\Component\Tenant\Migration\Version0_15_0
     */
    private $tenant;

    /**
     * Constructor
     *
     * @param \Doctrine\DBAL\Migrations\Version  $version
     */
    public function __construct(Version $version)
    {
        parent::__construct($version);
        $this->acl = new Acl($version);
        $this->config = new Config($version);
        $this->metadata = new Metadata($version);
        $this->parameter = new Parameter($version);
        $this->tenant = new Tenant($version);
    }

    /**
     * Up migration
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    public function up(Schema $schema)
    {
        $parameters = Parameters::parseFile(static::DIRECTORY.'/parameters.yaml');
        $this->acl->up($schema, Objects::parseFile(static::DIRECTORY.'/0_15_0/acl.yaml', $parameters));
        $this->config->setContainer($this->container)->up($schema, Objects::parseFile(static::DIRECTORY.'/0_15_0/config.yaml', $parameters));
        $this->metadata->up($schema, Objects::parseFile(static::DIRECTORY.'/0_15_0/metadata.yaml', $parameters));
        $this->parameter->setContainer($this->container)->up($schema, Objects::parseFile(static::DIRECTORY.'/0_15_0/system/parameter.yaml', $parameters));
        $this->tenant->up($schema, Objects::parseFile(static::DIRECTORY.'/0_15_0/system/tenant.yaml', $parameters));

        switch ($this->platform->getName()) {
            case 'postgresql':
                $this->addSql('CREATE SEQUENCE app_record_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
                $this->addSql('CREATE SEQUENCE app_record_association_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
                $this->addSql('CREATE SEQUENCE app_record_trans_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
                $this->addSql('CREATE TABLE app_record (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, identity VARCHAR(255) DEFAULT NULL, identity_uuid UUID DEFAULT NULL, data JSON NOT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
                $this->addSql('CREATE UNIQUE INDEX UNIQ_7E37F211D17F50A6 ON app_record (uuid)');
                $this->addSql('COMMENT ON COLUMN app_record.data IS \'(DC2Type:json_array)\'');
                $this->addSql('CREATE TABLE app_record_association (id INT NOT NULL, record_id INT DEFAULT NULL, uuid UUID NOT NULL, entity VARCHAR(255) NOT NULL, entity_uuid UUID NOT NULL, "owner" VARCHAR(255) NOT NULL, owner_uuid UUID NOT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
                $this->addSql('CREATE UNIQUE INDEX UNIQ_57646D0AD17F50A6 ON app_record_association (uuid)');
                $this->addSql('CREATE INDEX IDX_57646D0A4DFD750C ON app_record_association (record_id)');
                $this->addSql('CREATE TABLE app_record_trans (id INT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, locale VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
                $this->addSql('CREATE INDEX IDX_33F4A5602C2AC5D3 ON app_record_trans (translatable_id)');
                $this->addSql('CREATE UNIQUE INDEX app_record_trans_unique_translation ON app_record_trans (translatable_id, locale)');
                $this->addSql('ALTER TABLE app_record_association ADD CONSTRAINT FK_57646D0A4DFD750C FOREIGN KEY (record_id) REFERENCES app_record (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
                $this->addSql('ALTER TABLE app_record_trans ADD CONSTRAINT FK_33F4A5602C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_record (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
                break;

            default:
                $this->abortIf(true,'Migration cannot be executed on "'.$this->platform->getName().'".');
                break;
        }
    }

    /**
     * Down migration
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->acl->down($schema);
        $this->config->setContainer($this->container)->down($schema);
        $this->metadata->down($schema);
        $this->parameter->setContainer($this->container)->down($schema);
        $this->tenant->down($schema);

        switch ($this->platform->getName()) {
            case 'postgresql':
                $this->addSql('ALTER TABLE app_record_association DROP CONSTRAINT FK_57646D0A4DFD750C');
                $this->addSql('ALTER TABLE app_record_trans DROP CONSTRAINT FK_33F4A5602C2AC5D3');
                $this->addSql('DROP SEQUENCE app_record_id_seq CASCADE');
                $this->addSql('DROP SEQUENCE app_record_association_id_seq CASCADE');
                $this->addSql('DROP SEQUENCE app_record_trans_id_seq CASCADE');
                $this->addSql('DROP TABLE app_record');
                $this->addSql('DROP TABLE app_record_association');
                $this->addSql('DROP TABLE app_record_trans');
                break;

            default:
                $this->abortIf(true,'Migration cannot be executed on "'.$this->platform->getName().'".');
                break;
        }
    }
}
