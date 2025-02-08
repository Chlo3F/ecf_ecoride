<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250208210851 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis ADD chauffeur_id INT NOT NULL, CHANGE commentaire commentaire LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF085C0B3BE FOREIGN KEY (chauffeur_id) REFERENCES chauffeur (id)');
        $this->addSql('CREATE INDEX IDX_8F91ABF085C0B3BE ON avis (chauffeur_id)');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B371A51189');
        $this->addSql('DROP INDEX IDX_1D1C63B371A51189 ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur DROP passager_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF085C0B3BE');
        $this->addSql('DROP INDEX IDX_8F91ABF085C0B3BE ON avis');
        $this->addSql('ALTER TABLE avis DROP chauffeur_id, CHANGE commentaire commentaire VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD passager_id INT NOT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B371A51189 FOREIGN KEY (passager_id) REFERENCES passager (id)');
        $this->addSql('CREATE INDEX IDX_1D1C63B371A51189 ON utilisateur (passager_id)');
    }
}
