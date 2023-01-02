<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230102142445 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'mise en place des relations';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bloc_internaute (bloc_id INT NOT NULL, internaute_id INT NOT NULL, INDEX IDX_894E8E5A5582E9C0 (bloc_id), INDEX IDX_894E8E5ACAF41882 (internaute_id), PRIMARY KEY(bloc_id, internaute_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prestataire_categorie_services (prestataire_id INT NOT NULL, categorie_services_id INT NOT NULL, INDEX IDX_E453C499BE3DB2B7 (prestataire_id), INDEX IDX_E453C499710B80C8 (categorie_services_id), PRIMARY KEY(prestataire_id, categorie_services_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prestataire_internaute (prestataire_id INT NOT NULL, internaute_id INT NOT NULL, INDEX IDX_BA91FCF0BE3DB2B7 (prestataire_id), INDEX IDX_BA91FCF0CAF41882 (internaute_id), PRIMARY KEY(prestataire_id, internaute_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bloc_internaute ADD CONSTRAINT FK_894E8E5A5582E9C0 FOREIGN KEY (bloc_id) REFERENCES bloc (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bloc_internaute ADD CONSTRAINT FK_894E8E5ACAF41882 FOREIGN KEY (internaute_id) REFERENCES internaute (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prestataire_categorie_services ADD CONSTRAINT FK_E453C499BE3DB2B7 FOREIGN KEY (prestataire_id) REFERENCES prestataire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prestataire_categorie_services ADD CONSTRAINT FK_E453C499710B80C8 FOREIGN KEY (categorie_services_id) REFERENCES categorie_services (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prestataire_internaute ADD CONSTRAINT FK_BA91FCF0BE3DB2B7 FOREIGN KEY (prestataire_id) REFERENCES prestataire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prestataire_internaute ADD CONSTRAINT FK_BA91FCF0CAF41882 FOREIGN KEY (internaute_id) REFERENCES internaute (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_services ADD promotion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE categorie_services ADD CONSTRAINT FK_4BB5A003139DF194 FOREIGN KEY (promotion_id) REFERENCES promotion (id)');
        $this->addSql('CREATE INDEX IDX_4BB5A003139DF194 ON categorie_services (promotion_id)');
        $this->addSql('ALTER TABLE code_postal ADD utilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE code_postal ADD CONSTRAINT FK_CC94AC37FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_CC94AC37FB88E14F ON code_postal (utilisateur_id)');
        $this->addSql('ALTER TABLE commentaire ADD concerner_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC95131E34 FOREIGN KEY (concerner_id) REFERENCES abus (id)');
        $this->addSql('CREATE INDEX IDX_67F068BC95131E34 ON commentaire (concerner_id)');
        $this->addSql('ALTER TABLE commune ADD utilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commune ADD CONSTRAINT FK_E2E2D1EEFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_E2E2D1EEFB88E14F ON commune (utilisateur_id)');
        $this->addSql('ALTER TABLE images ADD photo_id INT DEFAULT NULL, ADD avatar_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A7E9E4C8C FOREIGN KEY (photo_id) REFERENCES categorie_services (id)');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A86383B10 FOREIGN KEY (avatar_id) REFERENCES internaute (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E01FBE6A7E9E4C8C ON images (photo_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E01FBE6A86383B10 ON images (avatar_id)');
        $this->addSql('ALTER TABLE internaute ADD commentaire_id INT DEFAULT NULL, ADD abus_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE internaute ADD CONSTRAINT FK_6C8E97CCBA9CD190 FOREIGN KEY (commentaire_id) REFERENCES commentaire (id)');
        $this->addSql('ALTER TABLE internaute ADD CONSTRAINT FK_6C8E97CC24294A91 FOREIGN KEY (abus_id) REFERENCES abus (id)');
        $this->addSql('CREATE INDEX IDX_6C8E97CCBA9CD190 ON internaute (commentaire_id)');
        $this->addSql('CREATE INDEX IDX_6C8E97CC24294A91 ON internaute (abus_id)');
        $this->addSql('ALTER TABLE localite ADD utilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE localite ADD CONSTRAINT FK_F5D7E4A9FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_F5D7E4A9FB88E14F ON localite (utilisateur_id)');
        $this->addSql('ALTER TABLE prestataire ADD images_id INT DEFAULT NULL, ADD profil_id INT DEFAULT NULL, ADD photo_id INT DEFAULT NULL, ADD organiser_id INT DEFAULT NULL, ADD offrir_id INT DEFAULT NULL, ADD concerner_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE prestataire ADD CONSTRAINT FK_60A26480D44F05E5 FOREIGN KEY (images_id) REFERENCES images (id)');
        $this->addSql('ALTER TABLE prestataire ADD CONSTRAINT FK_60A26480275ED078 FOREIGN KEY (profil_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE prestataire ADD CONSTRAINT FK_60A264807E9E4C8C FOREIGN KEY (photo_id) REFERENCES images (id)');
        $this->addSql('ALTER TABLE prestataire ADD CONSTRAINT FK_60A26480A0631C12 FOREIGN KEY (organiser_id) REFERENCES stage (id)');
        $this->addSql('ALTER TABLE prestataire ADD CONSTRAINT FK_60A2648011CF47FB FOREIGN KEY (offrir_id) REFERENCES promotion (id)');
        $this->addSql('ALTER TABLE prestataire ADD CONSTRAINT FK_60A2648095131E34 FOREIGN KEY (concerner_id) REFERENCES commentaire (id)');
        $this->addSql('CREATE INDEX IDX_60A26480D44F05E5 ON prestataire (images_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_60A26480275ED078 ON prestataire (profil_id)');
        $this->addSql('CREATE INDEX IDX_60A264807E9E4C8C ON prestataire (photo_id)');
        $this->addSql('CREATE INDEX IDX_60A26480A0631C12 ON prestataire (organiser_id)');
        $this->addSql('CREATE INDEX IDX_60A2648011CF47FB ON prestataire (offrir_id)');
        $this->addSql('CREATE INDEX IDX_60A2648095131E34 ON prestataire (concerner_id)');
        $this->addSql('ALTER TABLE utilisateur ADD profil_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3275ED078 FOREIGN KEY (profil_id) REFERENCES internaute (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B3275ED078 ON utilisateur (profil_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bloc_internaute DROP FOREIGN KEY FK_894E8E5A5582E9C0');
        $this->addSql('ALTER TABLE bloc_internaute DROP FOREIGN KEY FK_894E8E5ACAF41882');
        $this->addSql('ALTER TABLE prestataire_categorie_services DROP FOREIGN KEY FK_E453C499BE3DB2B7');
        $this->addSql('ALTER TABLE prestataire_categorie_services DROP FOREIGN KEY FK_E453C499710B80C8');
        $this->addSql('ALTER TABLE prestataire_internaute DROP FOREIGN KEY FK_BA91FCF0BE3DB2B7');
        $this->addSql('ALTER TABLE prestataire_internaute DROP FOREIGN KEY FK_BA91FCF0CAF41882');
        $this->addSql('DROP TABLE bloc_internaute');
        $this->addSql('DROP TABLE prestataire_categorie_services');
        $this->addSql('DROP TABLE prestataire_internaute');
        $this->addSql('ALTER TABLE categorie_services DROP FOREIGN KEY FK_4BB5A003139DF194');
        $this->addSql('DROP INDEX IDX_4BB5A003139DF194 ON categorie_services');
        $this->addSql('ALTER TABLE categorie_services DROP promotion_id');
        $this->addSql('ALTER TABLE code_postal DROP FOREIGN KEY FK_CC94AC37FB88E14F');
        $this->addSql('DROP INDEX IDX_CC94AC37FB88E14F ON code_postal');
        $this->addSql('ALTER TABLE code_postal DROP utilisateur_id');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC95131E34');
        $this->addSql('DROP INDEX IDX_67F068BC95131E34 ON commentaire');
        $this->addSql('ALTER TABLE commentaire DROP concerner_id');
        $this->addSql('ALTER TABLE commune DROP FOREIGN KEY FK_E2E2D1EEFB88E14F');
        $this->addSql('DROP INDEX IDX_E2E2D1EEFB88E14F ON commune');
        $this->addSql('ALTER TABLE commune DROP utilisateur_id');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6A7E9E4C8C');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6A86383B10');
        $this->addSql('DROP INDEX UNIQ_E01FBE6A7E9E4C8C ON images');
        $this->addSql('DROP INDEX UNIQ_E01FBE6A86383B10 ON images');
        $this->addSql('ALTER TABLE images DROP photo_id, DROP avatar_id');
        $this->addSql('ALTER TABLE internaute DROP FOREIGN KEY FK_6C8E97CCBA9CD190');
        $this->addSql('ALTER TABLE internaute DROP FOREIGN KEY FK_6C8E97CC24294A91');
        $this->addSql('DROP INDEX IDX_6C8E97CCBA9CD190 ON internaute');
        $this->addSql('DROP INDEX IDX_6C8E97CC24294A91 ON internaute');
        $this->addSql('ALTER TABLE internaute DROP commentaire_id, DROP abus_id');
        $this->addSql('ALTER TABLE localite DROP FOREIGN KEY FK_F5D7E4A9FB88E14F');
        $this->addSql('DROP INDEX IDX_F5D7E4A9FB88E14F ON localite');
        $this->addSql('ALTER TABLE localite DROP utilisateur_id');
        $this->addSql('ALTER TABLE prestataire DROP FOREIGN KEY FK_60A26480D44F05E5');
        $this->addSql('ALTER TABLE prestataire DROP FOREIGN KEY FK_60A26480275ED078');
        $this->addSql('ALTER TABLE prestataire DROP FOREIGN KEY FK_60A264807E9E4C8C');
        $this->addSql('ALTER TABLE prestataire DROP FOREIGN KEY FK_60A26480A0631C12');
        $this->addSql('ALTER TABLE prestataire DROP FOREIGN KEY FK_60A2648011CF47FB');
        $this->addSql('ALTER TABLE prestataire DROP FOREIGN KEY FK_60A2648095131E34');
        $this->addSql('DROP INDEX IDX_60A26480D44F05E5 ON prestataire');
        $this->addSql('DROP INDEX UNIQ_60A26480275ED078 ON prestataire');
        $this->addSql('DROP INDEX IDX_60A264807E9E4C8C ON prestataire');
        $this->addSql('DROP INDEX IDX_60A26480A0631C12 ON prestataire');
        $this->addSql('DROP INDEX IDX_60A2648011CF47FB ON prestataire');
        $this->addSql('DROP INDEX IDX_60A2648095131E34 ON prestataire');
        $this->addSql('ALTER TABLE prestataire DROP images_id, DROP profil_id, DROP photo_id, DROP organiser_id, DROP offrir_id, DROP concerner_id');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3275ED078');
        $this->addSql('DROP INDEX UNIQ_1D1C63B3275ED078 ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur DROP profil_id');
    }
}
