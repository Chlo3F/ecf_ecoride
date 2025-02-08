<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250208162106 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, passager_id INT NOT NULL, note INT NOT NULL, commentaire VARCHAR(255) NOT NULL, id_employe INT NOT NULL, valide TINYINT(1) NOT NULL, INDEX IDX_8F91ABF071A51189 (passager_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, passager_id INT NOT NULL, voyage_id INT NOT NULL, etat TINYINT(1) NOT NULL, INDEX IDX_42C8495571A51189 (passager_id), INDEX IDX_42C8495568C9E5AF (voyage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statistique (id INT AUTO_INCREMENT NOT NULL, administrateur_id INT NOT NULL, date DATETIME NOT NULL, nb_voyage INT NOT NULL, revenus INT NOT NULL, INDEX IDX_73A038AD7EE5403C (administrateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF071A51189 FOREIGN KEY (passager_id) REFERENCES passager (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495571A51189 FOREIGN KEY (passager_id) REFERENCES passager (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495568C9E5AF FOREIGN KEY (voyage_id) REFERENCES voyage (id)');
        $this->addSql('ALTER TABLE statistique ADD CONSTRAINT FK_73A038AD7EE5403C FOREIGN KEY (administrateur_id) REFERENCES administrateur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF071A51189');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495571A51189');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495568C9E5AF');
        $this->addSql('ALTER TABLE statistique DROP FOREIGN KEY FK_73A038AD7EE5403C');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE statistique');
    }
}
