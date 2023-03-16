<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230316141018 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'correction relation stage/prestataire';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        //$this->addSql('ALTER TABLE prestataire DROP FOREIGN KEY FK_60A26480A0631C12');
        //$this->addSql('DROP INDEX UNIQ_60A26480A0631C12 ON prestataire');
        $this->addSql('ALTER TABLE prestataire DROP organiser_id');
        $this->addSql('ALTER TABLE stage ADD prestataires_id INT NOT NULL');
        $this->addSql('ALTER TABLE stage ADD CONSTRAINT FK_C27C9369B2CAA6B8 FOREIGN KEY (prestataires_id) REFERENCES prestataire (id)');
        $this->addSql('CREATE INDEX IDX_C27C9369B2CAA6B8 ON stage (prestataires_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prestataire ADD organiser_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE prestataire ADD CONSTRAINT FK_60A26480A0631C12 FOREIGN KEY (organiser_id) REFERENCES stage (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_60A26480A0631C12 ON prestataire (organiser_id)');
        $this->addSql('ALTER TABLE stage DROP FOREIGN KEY FK_C27C9369B2CAA6B8');
        $this->addSql('DROP INDEX IDX_C27C9369B2CAA6B8 ON stage');
        $this->addSql('ALTER TABLE stage DROP prestataires_id');
    }
}
