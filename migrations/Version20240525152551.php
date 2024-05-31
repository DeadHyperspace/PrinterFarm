<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240525152551 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE models (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, plastic_length INT NOT NULL, durability INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE orders (id SERIAL NOT NULL, model_id INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, price INT NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E52FFDEE7975B7E7 ON orders (model_id)');
        $this->addSql('CREATE TABLE plastics (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, length INT NOT NULL, durability INT NOT NULL, min_temperature INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE printers_3d (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, max_temperature INT NOT NULL, print_speed INT NOT NULL, arrived_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE7975B7E7 FOREIGN KEY (model_id) REFERENCES models (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE orders DROP CONSTRAINT FK_E52FFDEE7975B7E7');
        $this->addSql('DROP TABLE models');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE plastics');
        $this->addSql('DROP TABLE printers_3d');
    }
}
