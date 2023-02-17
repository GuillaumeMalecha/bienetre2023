<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230216180452 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'modification de l\'utilisateur, la colonne confirmation d\'inscription peut être nulle';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateur CHANGE inscriptconf inscriptconf TINYINT(1) DEFAULT NULL, CHANGE nbessaisinfructueux nbessaisinfructueux INT DEFAULT NULL, CHANGE typeutilisateur typeutilisateur VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateur CHANGE inscriptconf inscriptconf TINYINT(1) NOT NULL, CHANGE nbessaisinfructueux nbessaisinfructueux INT NOT NULL, CHANGE typeutilisateur typeutilisateur VARCHAR(255) NOT NULL');
    }
}
