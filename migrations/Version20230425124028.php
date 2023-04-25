<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230425124028 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE espece (id INT AUTO_INCREMENT NOT NULL, genre VARCHAR(255) NOT NULL, espece VARCHAR(255) NOT NULL, photo LONGTEXT DEFAULT NULL, ordre VARCHAR(255) DEFAULT NULL, famille VARCHAR(255) DEFAULT NULL, nom_anglais VARCHAR(255) DEFAULT NULL, nom_francais VARCHAR(255) DEFAULT NULL, descripteur VARCHAR(255) DEFAULT NULL, decrit_en DATE DEFAULT NULL, habitat VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE espece');
    }
}
