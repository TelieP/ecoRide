<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250814124519 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE voiture_utilisateur (voiture_id INT NOT NULL, utilisateur_id INT NOT NULL, INDEX IDX_22D84E9F181A8BA (voiture_id), INDEX IDX_22D84E9FFB88E14F (utilisateur_id), PRIMARY KEY(voiture_id, utilisateur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE voiture_utilisateur ADD CONSTRAINT FK_22D84E9F181A8BA FOREIGN KEY (voiture_id) REFERENCES voiture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voiture_utilisateur ADD CONSTRAINT FK_22D84E9FFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voiture_utilisateur DROP FOREIGN KEY FK_22D84E9F181A8BA');
        $this->addSql('ALTER TABLE voiture_utilisateur DROP FOREIGN KEY FK_22D84E9FFB88E14F');
        $this->addSql('DROP TABLE voiture_utilisateur');
    }
}
