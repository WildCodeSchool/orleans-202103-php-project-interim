<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210617083917 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, company_name VARCHAR(255) NOT NULL, social_reason VARCHAR(255) NOT NULL, siret VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job (id INT AUTO_INCREMENT NOT NULL, company_id INT DEFAULT NULL, study_field_id INT NOT NULL, post VARCHAR(255) NOT NULL, registered_at DATE NOT NULL, start_at DATE NOT NULL, end_at DATE NOT NULL, hours_aweek INT NOT NULL, city VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_FBD8E0F8979B1AD6 (company_id), INDEX IDX_FBD8E0F8E7BE1239 (study_field_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE study_field (id INT AUTO_INCREMENT NOT NULL, study_field_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F8979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F8E7BE1239 FOREIGN KEY (study_field_id) REFERENCES study_field (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F8979B1AD6');
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F8E7BE1239');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE job');
        $this->addSql('DROP TABLE study_field');
        $this->addSql('DROP TABLE user');
    }
}
