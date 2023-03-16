<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230316135225 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Correction de la relation entre Prestataire et Organiser : ManyToOne=>OneToOne';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prestataire DROP INDEX IDX_60A26480A0631C12, ADD UNIQUE INDEX UNIQ_60A26480A0631C12 (organiser_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prestataire DROP INDEX UNIQ_60A26480A0631C12, ADD INDEX IDX_60A26480A0631C12 (organiser_id)');
    }
}
