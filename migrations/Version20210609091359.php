<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210609091359 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE job (id INT AUTO_INCREMENT NOT NULL, companyId_id INT NOT NULL, post VARCHAR(200) NOT NULL, registered_at DATE NOT NULL, start_at DATE NOT NULL, end_at DATE NOT NULL, hours_aweek INT NOT NULL, city VARCHAR(255) NOT NULL, postal_code INT NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_FBD8E0F838B53C32 (companyId_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F838B53C32 FOREIGN KEY (companyId_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE study_field ADD job_id INT NOT NULL');
        $this->addSql('ALTER TABLE study_field ADD CONSTRAINT FK_48F15B8BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id)');
        $this->addSql('CREATE INDEX IDX_48F15B8BE04EA9 ON study_field (job_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE study_field DROP FOREIGN KEY FK_48F15B8BE04EA9');
        $this->addSql('DROP TABLE job');
        $this->addSql('DROP INDEX IDX_48F15B8BE04EA9 ON study_field');
        $this->addSql('ALTER TABLE study_field DROP job_id');
    }
}
