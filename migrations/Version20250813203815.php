<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250813203815 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participe ADD covoiturage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE participe ADD CONSTRAINT FK_9FFA8D462671590 FOREIGN KEY (covoiturage_id) REFERENCES covoiturage (id)');
        $this->addSql('CREATE INDEX IDX_9FFA8D462671590 ON participe (covoiturage_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participe DROP FOREIGN KEY FK_9FFA8D462671590');
        $this->addSql('DROP INDEX IDX_9FFA8D462671590 ON participe');
        $this->addSql('ALTER TABLE participe DROP covoiturage_id');
    }
}
