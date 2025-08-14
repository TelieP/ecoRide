<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250814084712 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE utilisateur_voiture (utilisateur_id INT NOT NULL, voiture_id INT NOT NULL, INDEX IDX_93E9769DFB88E14F (utilisateur_id), INDEX IDX_93E9769D181A8BA (voiture_id), PRIMARY KEY(utilisateur_id, voiture_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE utilisateur_voiture ADD CONSTRAINT FK_93E9769DFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_voiture ADD CONSTRAINT FK_93E9769D181A8BA FOREIGN KEY (voiture_id) REFERENCES voiture (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateur_voiture DROP FOREIGN KEY FK_93E9769DFB88E14F');
        $this->addSql('ALTER TABLE utilisateur_voiture DROP FOREIGN KEY FK_93E9769D181A8BA');
        $this->addSql('DROP TABLE utilisateur_voiture');
    }
}
