<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230316173439 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'correction relation stage et prestataire';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stage DROP FOREIGN KEY FK_C27C9369B2CAA6B8');
        $this->addSql('DROP INDEX IDX_C27C9369B2CAA6B8 ON stage');
        $this->addSql('ALTER TABLE stage CHANGE prestataires_id prestataire_id INT NOT NULL');
        $this->addSql('ALTER TABLE stage ADD CONSTRAINT FK_C27C9369BE3DB2B7 FOREIGN KEY (prestataire_id) REFERENCES prestataire (id)');
        $this->addSql('CREATE INDEX IDX_C27C9369BE3DB2B7 ON stage (prestataire_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stage DROP FOREIGN KEY FK_C27C9369BE3DB2B7');
        $this->addSql('DROP INDEX IDX_C27C9369BE3DB2B7 ON stage');
        $this->addSql('ALTER TABLE stage CHANGE prestataire_id prestataires_id INT NOT NULL');
        $this->addSql('ALTER TABLE stage ADD CONSTRAINT FK_C27C9369B2CAA6B8 FOREIGN KEY (prestataires_id) REFERENCES prestataire (id)');
        $this->addSql('CREATE INDEX IDX_C27C9369B2CAA6B8 ON stage (prestataires_id)');
    }
}
