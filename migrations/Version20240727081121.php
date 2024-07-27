<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240727081121 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE models DROP CONSTRAINT FK_E4D63009DA57EBE9');
        $this->addSql('DROP INDEX uniq_e4d63009da57ebe9');
        $this->addSql('ALTER TABLE models ADD CONSTRAINT FK_E4D63009DA57EBE9 FOREIGN KEY (plastic_id) REFERENCES plastics (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_E4D63009DA57EBE9 ON models (plastic_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE models DROP CONSTRAINT fk_e4d63009da57ebe9');
        $this->addSql('DROP INDEX IDX_E4D63009DA57EBE9');
        $this->addSql('ALTER TABLE models ADD CONSTRAINT fk_e4d63009da57ebe9 FOREIGN KEY (plastic_id) REFERENCES plastics (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uniq_e4d63009da57ebe9 ON models (plastic_id)');
    }
}
