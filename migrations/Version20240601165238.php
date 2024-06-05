<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240601165238 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE models (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, plastic_length INT NOT NULL, durability INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE order_models (model_id INT NOT NULL, order_id INT NOT NULL, PRIMARY KEY(model_id, order_id))');
        $this->addSql('CREATE INDEX IDX_275920DC7975B7E7 ON order_models (model_id)');
        $this->addSql('CREATE INDEX IDX_275920DC8D9F6D38 ON order_models (order_id)');
        $this->addSql('CREATE TABLE orders (id SERIAL NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, price INT NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE plastics (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, length INT NOT NULL, durability INT NOT NULL, min_temperature INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE printers_3d (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, max_temperature INT NOT NULL, print_speed INT NOT NULL, arrived_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE order_models ADD CONSTRAINT FK_275920DC7975B7E7 FOREIGN KEY (model_id) REFERENCES models (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE order_models ADD CONSTRAINT FK_275920DC8D9F6D38 FOREIGN KEY (order_id) REFERENCES orders (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE order_models DROP CONSTRAINT FK_275920DC7975B7E7');
        $this->addSql('ALTER TABLE order_models DROP CONSTRAINT FK_275920DC8D9F6D38');
        $this->addSql('ALTER TABLE orders DROP CONSTRAINT FK_E52FFDEE8D9F6D38');
        $this->addSql('DROP TABLE models');
        $this->addSql('DROP TABLE order_models');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE plastics');
        $this->addSql('DROP TABLE printers_3d');
    }
}
