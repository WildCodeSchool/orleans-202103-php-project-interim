<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210617100928 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE study_field (id INT AUTO_INCREMENT NOT NULL, study_field_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE job ADD study_field_id INT NOT NULL');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F8E7BE1239 FOREIGN KEY (study_field_id) REFERENCES study_field (id)');
        $this->addSql('CREATE INDEX IDX_FBD8E0F8E7BE1239 ON job (study_field_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F8E7BE1239');
        $this->addSql('DROP TABLE study_field');
        $this->addSql('DROP INDEX IDX_FBD8E0F8E7BE1239 ON job');
        $this->addSql('ALTER TABLE job DROP study_field_id');
    }
}