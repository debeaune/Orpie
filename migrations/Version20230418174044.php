<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230418174044 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE especes CHANGE ordre ordre VARCHAR(255) DEFAULT NULL, CHANGE famille famille VARCHAR(255) DEFAULT NULL, CHANGE auteur auteur VARCHAR(255) DEFAULT NULL, CHANGE nom_anglais nom_anglais VARCHAR(255) DEFAULT NULL, CHANGE nom_francais nom_francais VARCHAR(255) DEFAULT NULL, CHANGE decrit_en decrit_en DATETIME NOT NULL, CHANGE update_at update_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE especes CHANGE famille famille VARCHAR(255) NOT NULL, CHANGE auteur auteur VARCHAR(255) NOT NULL, CHANGE nom_anglais nom_anglais VARCHAR(255) NOT NULL, CHANGE nom_francais nom_francais VARCHAR(255) NOT NULL, CHANGE decrit_en decrit_en DATETIME DEFAULT NULL, CHANGE update_at update_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE ordre ordre VARCHAR(255) NOT NULL');
    }
}
