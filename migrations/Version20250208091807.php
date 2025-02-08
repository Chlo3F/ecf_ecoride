<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250208091807 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE administrateur (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, UNIQUE INDEX UNIQ_32EB52E8FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chauffeur (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, preference_id INT NOT NULL, UNIQUE INDEX UNIQ_5CA777B8FB88E14F (utilisateur_id), INDEX IDX_5CA777B8D81022C0 (preference_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employe (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, UNIQUE INDEX UNIQ_F804D3B9FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE preference (id INT AUTO_INCREMENT NOT NULL, type_preference LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', valeur_boolean TINYINT(1) NOT NULL, valeur_personnalise VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicule (id INT AUTO_INCREMENT NOT NULL, chauffeur_id INT NOT NULL, immatriculation VARCHAR(10) NOT NULL, date_premiere_immatriculation DATE NOT NULL, marque_voiture VARCHAR(50) NOT NULL, modele_voiture VARCHAR(50) NOT NULL, couleur VARCHAR(20) NOT NULL, type_energie LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', INDEX IDX_292FFF1D85C0B3BE (chauffeur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ville (id INT AUTO_INCREMENT NOT NULL, nom_ville VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voyage (id INT AUTO_INCREMENT NOT NULL, chauffeur_id INT NOT NULL, id_ville_depart VARCHAR(50) NOT NULL, id_ville_arrivee VARCHAR(50) NOT NULL, date_heure_depart DATETIME NOT NULL, date_heure_arrivee DATETIME NOT NULL, prix INT NOT NULL, nb_places INT NOT NULL, ecologique TINYINT(1) NOT NULL, INDEX IDX_3F9D895585C0B3BE (chauffeur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voyage_ville (voyage_id INT NOT NULL, ville_id INT NOT NULL, INDEX IDX_4953E52C68C9E5AF (voyage_id), INDEX IDX_4953E52CA73F0036 (ville_id), PRIMARY KEY(voyage_id, ville_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE administrateur ADD CONSTRAINT FK_32EB52E8FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE chauffeur ADD CONSTRAINT FK_5CA777B8FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE chauffeur ADD CONSTRAINT FK_5CA777B8D81022C0 FOREIGN KEY (preference_id) REFERENCES preference (id)');
        $this->addSql('ALTER TABLE employe ADD CONSTRAINT FK_F804D3B9FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1D85C0B3BE FOREIGN KEY (chauffeur_id) REFERENCES chauffeur (id)');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D895585C0B3BE FOREIGN KEY (chauffeur_id) REFERENCES chauffeur (id)');
        $this->addSql('ALTER TABLE voyage_ville ADD CONSTRAINT FK_4953E52C68C9E5AF FOREIGN KEY (voyage_id) REFERENCES voyage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voyage_ville ADD CONSTRAINT FK_4953E52CA73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE administrateur DROP FOREIGN KEY FK_32EB52E8FB88E14F');
        $this->addSql('ALTER TABLE chauffeur DROP FOREIGN KEY FK_5CA777B8FB88E14F');
        $this->addSql('ALTER TABLE chauffeur DROP FOREIGN KEY FK_5CA777B8D81022C0');
        $this->addSql('ALTER TABLE employe DROP FOREIGN KEY FK_F804D3B9FB88E14F');
        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1D85C0B3BE');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D895585C0B3BE');
        $this->addSql('ALTER TABLE voyage_ville DROP FOREIGN KEY FK_4953E52C68C9E5AF');
        $this->addSql('ALTER TABLE voyage_ville DROP FOREIGN KEY FK_4953E52CA73F0036');
        $this->addSql('DROP TABLE administrateur');
        $this->addSql('DROP TABLE chauffeur');
        $this->addSql('DROP TABLE employe');
        $this->addSql('DROP TABLE preference');
        $this->addSql('DROP TABLE vehicule');
        $this->addSql('DROP TABLE ville');
        $this->addSql('DROP TABLE voyage');
        $this->addSql('DROP TABLE voyage_ville');
    }
}
