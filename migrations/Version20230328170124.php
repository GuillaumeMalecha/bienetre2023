<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230328170124 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'correction de la relation entre utilisateur et internaute';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE internaute ADD profil_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE internaute ADD CONSTRAINT FK_6C8E97CC275ED078 FOREIGN KEY (profil_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6C8E97CC275ED078 ON internaute (profil_id)');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3275ED078');
        $this->addSql('DROP INDEX UNIQ_1D1C63B3275ED078 ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur DROP profil_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE internaute DROP FOREIGN KEY FK_6C8E97CC275ED078');
        $this->addSql('DROP INDEX UNIQ_6C8E97CC275ED078 ON internaute');
        $this->addSql('ALTER TABLE internaute DROP profil_id');
        $this->addSql('ALTER TABLE utilisateur ADD profil_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3275ED078 FOREIGN KEY (profil_id) REFERENCES internaute (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B3275ED078 ON utilisateur (profil_id)');
    }
}
