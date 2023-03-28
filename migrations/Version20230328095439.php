<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230328095439 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Initialisation de la base de données';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE abus (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) NOT NULL, encodage DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bloc (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bloc_internaute (bloc_id INT NOT NULL, internaute_id INT NOT NULL, INDEX IDX_894E8E5A5582E9C0 (bloc_id), INDEX IDX_894E8E5ACAF41882 (internaute_id), PRIMARY KEY(bloc_id, internaute_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_services (id INT AUTO_INCREMENT NOT NULL, promotion_id INT DEFAULT NULL, description VARCHAR(255) NOT NULL, enavant TINYINT(1) NOT NULL, nom VARCHAR(255) NOT NULL, valide TINYINT(1) NOT NULL, INDEX IDX_4BB5A003139DF194 (promotion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE code_postal (id INT AUTO_INCREMENT NOT NULL, codepostal VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, concerner_id INT DEFAULT NULL, contenu VARCHAR(255) NOT NULL, cote INT DEFAULT NULL, encodage DATE NOT NULL, titre VARCHAR(255) NOT NULL, INDEX IDX_67F068BC95131E34 (concerner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commune (id INT AUTO_INCREMENT NOT NULL, commune VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE images (id INT AUTO_INCREMENT NOT NULL, photo_id INT DEFAULT NULL, avatar_id INT DEFAULT NULL, image VARCHAR(255) NOT NULL, ordre INT DEFAULT NULL, UNIQUE INDEX UNIQ_E01FBE6A7E9E4C8C (photo_id), UNIQUE INDEX UNIQ_E01FBE6A86383B10 (avatar_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE internaute (id INT AUTO_INCREMENT NOT NULL, commentaire_id INT DEFAULT NULL, abus_id INT DEFAULT NULL, newsletter TINYINT(1) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, INDEX IDX_6C8E97CCBA9CD190 (commentaire_id), INDEX IDX_6C8E97CC24294A91 (abus_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE localite (id INT AUTO_INCREMENT NOT NULL, localite VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE newsletter (id INT AUTO_INCREMENT NOT NULL, documentpdf VARCHAR(255) NOT NULL, publication DATE NOT NULL, titre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prestataire (id INT AUTO_INCREMENT NOT NULL, images_id INT DEFAULT NULL, profil_id INT DEFAULT NULL, photo_id INT DEFAULT NULL, concerner_id INT DEFAULT NULL, emailcontact VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, numtel VARCHAR(255) NOT NULL, numtva VARCHAR(255) NOT NULL, siteinternet VARCHAR(255) NOT NULL, INDEX IDX_60A26480D44F05E5 (images_id), UNIQUE INDEX UNIQ_60A26480275ED078 (profil_id), INDEX IDX_60A264807E9E4C8C (photo_id), INDEX IDX_60A2648095131E34 (concerner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prestataire_categorie_services (prestataire_id INT NOT NULL, categorie_services_id INT NOT NULL, INDEX IDX_E453C499BE3DB2B7 (prestataire_id), INDEX IDX_E453C499710B80C8 (categorie_services_id), PRIMARY KEY(prestataire_id, categorie_services_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prestataire_internaute (prestataire_id INT NOT NULL, internaute_id INT NOT NULL, INDEX IDX_BA91FCF0BE3DB2B7 (prestataire_id), INDEX IDX_BA91FCF0CAF41882 (internaute_id), PRIMARY KEY(prestataire_id, internaute_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE promotion (id INT AUTO_INCREMENT NOT NULL, prestataire_id INT NOT NULL, affichagede DATE NOT NULL, affichagejusque DATE NOT NULL, debut DATE NOT NULL, description VARCHAR(255) NOT NULL, documentpdf VARCHAR(255) DEFAULT NULL, fin DATE NOT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_C11D7DD1BE3DB2B7 (prestataire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stage (id INT AUTO_INCREMENT NOT NULL, prestataire_id INT NOT NULL, affichagede DATE NOT NULL, affichagejusque DATE NOT NULL, debut DATE NOT NULL, description VARCHAR(255) NOT NULL, fin DATE NOT NULL, infocomplementaire VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, tarif VARCHAR(255) NOT NULL, INDEX IDX_C27C9369BE3DB2B7 (prestataire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, codepostal_id INT DEFAULT NULL, localite_id INT DEFAULT NULL, commune_id INT DEFAULT NULL, profil_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, adressenum VARCHAR(255) DEFAULT NULL, adresserue VARCHAR(255) DEFAULT NULL, banni TINYINT(1) DEFAULT NULL, inscriptconf TINYINT(1) DEFAULT NULL, inscription DATE NOT NULL, nbessaisinfructueux INT DEFAULT NULL, typeutilisateur VARCHAR(255) DEFAULT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_1D1C63B3E7927C74 (email), INDEX IDX_1D1C63B3C9B1D722 (codepostal_id), INDEX IDX_1D1C63B3924DD2B5 (localite_id), INDEX IDX_1D1C63B3131A4F72 (commune_id), UNIQUE INDEX UNIQ_1D1C63B3275ED078 (profil_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bloc_internaute ADD CONSTRAINT FK_894E8E5A5582E9C0 FOREIGN KEY (bloc_id) REFERENCES bloc (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bloc_internaute ADD CONSTRAINT FK_894E8E5ACAF41882 FOREIGN KEY (internaute_id) REFERENCES internaute (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_services ADD CONSTRAINT FK_4BB5A003139DF194 FOREIGN KEY (promotion_id) REFERENCES promotion (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC95131E34 FOREIGN KEY (concerner_id) REFERENCES abus (id)');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A7E9E4C8C FOREIGN KEY (photo_id) REFERENCES categorie_services (id)');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A86383B10 FOREIGN KEY (avatar_id) REFERENCES internaute (id)');
        $this->addSql('ALTER TABLE internaute ADD CONSTRAINT FK_6C8E97CCBA9CD190 FOREIGN KEY (commentaire_id) REFERENCES commentaire (id)');
        $this->addSql('ALTER TABLE internaute ADD CONSTRAINT FK_6C8E97CC24294A91 FOREIGN KEY (abus_id) REFERENCES abus (id)');
        $this->addSql('ALTER TABLE prestataire ADD CONSTRAINT FK_60A26480D44F05E5 FOREIGN KEY (images_id) REFERENCES images (id)');
        $this->addSql('ALTER TABLE prestataire ADD CONSTRAINT FK_60A26480275ED078 FOREIGN KEY (profil_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE prestataire ADD CONSTRAINT FK_60A264807E9E4C8C FOREIGN KEY (photo_id) REFERENCES images (id)');
        $this->addSql('ALTER TABLE prestataire ADD CONSTRAINT FK_60A2648095131E34 FOREIGN KEY (concerner_id) REFERENCES commentaire (id)');
        $this->addSql('ALTER TABLE prestataire_categorie_services ADD CONSTRAINT FK_E453C499BE3DB2B7 FOREIGN KEY (prestataire_id) REFERENCES prestataire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prestataire_categorie_services ADD CONSTRAINT FK_E453C499710B80C8 FOREIGN KEY (categorie_services_id) REFERENCES categorie_services (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prestataire_internaute ADD CONSTRAINT FK_BA91FCF0BE3DB2B7 FOREIGN KEY (prestataire_id) REFERENCES prestataire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prestataire_internaute ADD CONSTRAINT FK_BA91FCF0CAF41882 FOREIGN KEY (internaute_id) REFERENCES internaute (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE promotion ADD CONSTRAINT FK_C11D7DD1BE3DB2B7 FOREIGN KEY (prestataire_id) REFERENCES prestataire (id)');
        $this->addSql('ALTER TABLE stage ADD CONSTRAINT FK_C27C9369BE3DB2B7 FOREIGN KEY (prestataire_id) REFERENCES prestataire (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3C9B1D722 FOREIGN KEY (codepostal_id) REFERENCES code_postal (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3924DD2B5 FOREIGN KEY (localite_id) REFERENCES localite (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3131A4F72 FOREIGN KEY (commune_id) REFERENCES commune (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3275ED078 FOREIGN KEY (profil_id) REFERENCES internaute (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bloc_internaute DROP FOREIGN KEY FK_894E8E5A5582E9C0');
        $this->addSql('ALTER TABLE bloc_internaute DROP FOREIGN KEY FK_894E8E5ACAF41882');
        $this->addSql('ALTER TABLE categorie_services DROP FOREIGN KEY FK_4BB5A003139DF194');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC95131E34');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6A7E9E4C8C');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6A86383B10');
        $this->addSql('ALTER TABLE internaute DROP FOREIGN KEY FK_6C8E97CCBA9CD190');
        $this->addSql('ALTER TABLE internaute DROP FOREIGN KEY FK_6C8E97CC24294A91');
        $this->addSql('ALTER TABLE prestataire DROP FOREIGN KEY FK_60A26480D44F05E5');
        $this->addSql('ALTER TABLE prestataire DROP FOREIGN KEY FK_60A26480275ED078');
        $this->addSql('ALTER TABLE prestataire DROP FOREIGN KEY FK_60A264807E9E4C8C');
        $this->addSql('ALTER TABLE prestataire DROP FOREIGN KEY FK_60A2648095131E34');
        $this->addSql('ALTER TABLE prestataire_categorie_services DROP FOREIGN KEY FK_E453C499BE3DB2B7');
        $this->addSql('ALTER TABLE prestataire_categorie_services DROP FOREIGN KEY FK_E453C499710B80C8');
        $this->addSql('ALTER TABLE prestataire_internaute DROP FOREIGN KEY FK_BA91FCF0BE3DB2B7');
        $this->addSql('ALTER TABLE prestataire_internaute DROP FOREIGN KEY FK_BA91FCF0CAF41882');
        $this->addSql('ALTER TABLE promotion DROP FOREIGN KEY FK_C11D7DD1BE3DB2B7');
        $this->addSql('ALTER TABLE stage DROP FOREIGN KEY FK_C27C9369BE3DB2B7');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3C9B1D722');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3924DD2B5');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3131A4F72');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3275ED078');
        $this->addSql('DROP TABLE abus');
        $this->addSql('DROP TABLE bloc');
        $this->addSql('DROP TABLE bloc_internaute');
        $this->addSql('DROP TABLE categorie_services');
        $this->addSql('DROP TABLE code_postal');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE commune');
        $this->addSql('DROP TABLE images');
        $this->addSql('DROP TABLE internaute');
        $this->addSql('DROP TABLE localite');
        $this->addSql('DROP TABLE newsletter');
        $this->addSql('DROP TABLE prestataire');
        $this->addSql('DROP TABLE prestataire_categorie_services');
        $this->addSql('DROP TABLE prestataire_internaute');
        $this->addSql('DROP TABLE promotion');
        $this->addSql('DROP TABLE stage');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
