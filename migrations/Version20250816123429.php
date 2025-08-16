<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250816123429 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE utilisateur_covoiturage (utilisateur_id INT NOT NULL, covoiturage_id INT NOT NULL, INDEX IDX_DC21931AFB88E14F (utilisateur_id), INDEX IDX_DC21931A62671590 (covoiturage_id), PRIMARY KEY(utilisateur_id, covoiturage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE utilisateur_covoiturage ADD CONSTRAINT FK_DC21931AFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_covoiturage ADD CONSTRAINT FK_DC21931A62671590 FOREIGN KEY (covoiturage_id) REFERENCES covoiturage (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE role');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE utilisateur_covoiturage DROP FOREIGN KEY FK_DC21931AFB88E14F');
        $this->addSql('ALTER TABLE utilisateur_covoiturage DROP FOREIGN KEY FK_DC21931A62671590');
        $this->addSql('DROP TABLE utilisateur_covoiturage');
    }
}
