<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230316180358 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'correction de la relation entre promotion et prestataire';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prestataire DROP FOREIGN KEY FK_60A2648011CF47FB');
        $this->addSql('DROP INDEX IDX_60A2648011CF47FB ON prestataire');
        $this->addSql('ALTER TABLE prestataire DROP offrir_id');
        $this->addSql('ALTER TABLE promotion ADD prestataire_id INT NOT NULL');
        $this->addSql('ALTER TABLE promotion ADD CONSTRAINT FK_C11D7DD1BE3DB2B7 FOREIGN KEY (prestataire_id) REFERENCES prestataire (id)');
        $this->addSql('CREATE INDEX IDX_C11D7DD1BE3DB2B7 ON promotion (prestataire_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prestataire ADD offrir_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE prestataire ADD CONSTRAINT FK_60A2648011CF47FB FOREIGN KEY (offrir_id) REFERENCES promotion (id)');
        $this->addSql('CREATE INDEX IDX_60A2648011CF47FB ON prestataire (offrir_id)');
        $this->addSql('ALTER TABLE promotion DROP FOREIGN KEY FK_C11D7DD1BE3DB2B7');
        $this->addSql('DROP INDEX IDX_C11D7DD1BE3DB2B7 ON promotion');
        $this->addSql('ALTER TABLE promotion DROP prestataire_id');
    }
}
