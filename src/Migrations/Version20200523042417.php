<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200523042417 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE property_option DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE property_option ADD PRIMARY KEY (property_id, option_id)');
        $this->addSql('ALTER TABLE property_option RENAME INDEX idx_ab856d7a549213ec TO IDX_24F16FCC549213EC');
        $this->addSql('ALTER TABLE property_option RENAME INDEX idx_ab856d7aa7c41d6f TO IDX_24F16FCCA7C41D6F');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE property_option DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE property_option ADD PRIMARY KEY (option_id, property_id)');
        $this->addSql('ALTER TABLE property_option RENAME INDEX idx_24f16fcca7c41d6f TO IDX_AB856D7AA7C41D6F');
        $this->addSql('ALTER TABLE property_option RENAME INDEX idx_24f16fcc549213ec TO IDX_AB856D7A549213EC');
    }
}
