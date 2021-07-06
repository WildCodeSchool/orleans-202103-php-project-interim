<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210625105228 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F8E7BE1239 FOREIGN KEY (study_field_id) REFERENCES study_field (id)');
        $this->addSql('CREATE INDEX IDX_FBD8E0F8E7BE1239 ON job (study_field_id)');
        $this->addSql('ALTER TABLE user ADD company_id INT DEFAULT NULL, ADD phone VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649979B1AD6 ON user (company_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F8E7BE1239');
        $this->addSql('DROP INDEX IDX_FBD8E0F8E7BE1239 ON job');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649979B1AD6');
        $this->addSql('DROP INDEX UNIQ_8D93D649979B1AD6 ON user');
        $this->addSql('ALTER TABLE user DROP company_id, DROP phone');
    }
}
