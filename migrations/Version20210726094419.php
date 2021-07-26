<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210726094419 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("INSERT INTO study_field (study_field_name) VALUES ('Général'), ('Droit'), ('Economie'),
        ('Gestion'), ('STAPS'), ('Biologie'), ('Chimie'), ('Informatique'), ('Mathématiques'),
        ('Physique'), ('Histoire'), ('Langues'), ('Lettres'), ('Géographie et Aménagement'),
        ('Polytech'), ('Médecine'),
        ('MEEF')");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('TRUNCATE TABLE study_field');
    }
}
