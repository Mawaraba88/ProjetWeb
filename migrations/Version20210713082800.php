<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210713082800 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE documenttype DROP FOREIGN KEY FK_121FBC37FBEBC999');
        $this->addSql('DROP TABLE donnees_type');
        $this->addSql('DROP INDEX IDX_121FBC37FBEBC999 ON documenttype');
        $this->addSql('ALTER TABLE documenttype DROP donnees_type_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE donnees_type (id INT AUTO_INCREMENT NOT NULL, categorydonnees_id INT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_13C8FFCEC5290191 (categorydonnees_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE donnees_type ADD CONSTRAINT FK_13C8FFCEC5290191 FOREIGN KEY (categorydonnees_id) REFERENCES category_donnees (id)');
        $this->addSql('ALTER TABLE documenttype ADD donnees_type_id INT NOT NULL');
        $this->addSql('ALTER TABLE documenttype ADD CONSTRAINT FK_121FBC37FBEBC999 FOREIGN KEY (donnees_type_id) REFERENCES donnees_type (id)');
        $this->addSql('CREATE INDEX IDX_121FBC37FBEBC999 ON documenttype (donnees_type_id)');
    }
}
