<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210721102355 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE news ADD duration_of_publication DATE DEFAULT NULL, CHANGE created_at created_at DATETIME NOT NULL, CHANGE start_created_at start_created_at DATETIME DEFAULT NULL, CHANGE end_created_at end_created_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE news DROP duration_of_publication, CHANGE created_at created_at DATE NOT NULL, CHANGE start_created_at start_created_at DATE DEFAULT NULL, CHANGE end_created_at end_created_at DATE DEFAULT NULL');
    }
}
