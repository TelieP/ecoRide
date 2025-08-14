<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250814085453 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE voiture_voiture (voiture_source INT NOT NULL, voiture_target INT NOT NULL, INDEX IDX_14A38CBF7C7EB569 (voiture_source), INDEX IDX_14A38CBF659BE5E6 (voiture_target), PRIMARY KEY(voiture_source, voiture_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE voiture_voiture ADD CONSTRAINT FK_14A38CBF7C7EB569 FOREIGN KEY (voiture_source) REFERENCES voiture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voiture_voiture ADD CONSTRAINT FK_14A38CBF659BE5E6 FOREIGN KEY (voiture_target) REFERENCES voiture (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voiture_voiture DROP FOREIGN KEY FK_14A38CBF7C7EB569');
        $this->addSql('ALTER TABLE voiture_voiture DROP FOREIGN KEY FK_14A38CBF659BE5E6');
        $this->addSql('DROP TABLE voiture_voiture');
    }
}
