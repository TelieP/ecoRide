<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250816202251 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE marque_voiture (marque_id INT NOT NULL, voiture_id INT NOT NULL, INDEX IDX_3038221A4827B9B2 (marque_id), INDEX IDX_3038221A181A8BA (voiture_id), PRIMARY KEY(marque_id, voiture_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE marque_voiture ADD CONSTRAINT FK_3038221A4827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE marque_voiture ADD CONSTRAINT FK_3038221A181A8BA FOREIGN KEY (voiture_id) REFERENCES voiture (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE marque_voiture DROP FOREIGN KEY FK_3038221A4827B9B2');
        $this->addSql('ALTER TABLE marque_voiture DROP FOREIGN KEY FK_3038221A181A8BA');
        $this->addSql('DROP TABLE marque_voiture');
    }
}
