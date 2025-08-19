<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250819114800 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE covoiturage ADD date_depart TIME NOT NULL, ADD heure_depart TIME NOT NULL, ADD lieu_depart VARCHAR(255) NOT NULL, ADD date_arrivee DATE NOT NULL, ADD heure_arrivee TIME NOT NULL, ADD lieu_arrivee VARCHAR(255) NOT NULL, ADD statut VARCHAR(255) DEFAULT NULL, ADD nb_place DOUBLE PRECISION NOT NULL, ADD prix_personne DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE covoiturage DROP date_depart, DROP heure_depart, DROP lieu_depart, DROP date_arrivee, DROP heure_arrivee, DROP lieu_arrivee, DROP statut, DROP nb_place, DROP prix_personne');
    }
}
