<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230912122005 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE horaire_garage ADD ouverture_matin VARCHAR(255) DEFAULT NULL, ADD fermeture_matin VARCHAR(255) DEFAULT NULL, ADD ouverture_apres_midi VARCHAR(255) DEFAULT NULL, ADD fermeture_apres_midi VARCHAR(255) DEFAULT NULL, DROP ouverture, DROP fermeture');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE horaire_garage ADD ouverture VARCHAR(255) DEFAULT NULL, ADD fermeture VARCHAR(255) DEFAULT NULL, DROP ouverture_matin, DROP fermeture_matin, DROP ouverture_apres_midi, DROP fermeture_apres_midi');
    }
}
