<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210621131105 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category_data (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_data (id INT AUTO_INCREMENT NOT NULL, categorydata_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_7AFC366BC12E8CC4 (categorydata_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE type_data ADD CONSTRAINT FK_7AFC366BC12E8CC4 FOREIGN KEY (categorydata_id) REFERENCES category_data (id)');
        $this->addSql('ALTER TABLE documenttype ADD type_data_id INT NOT NULL');
        $this->addSql('ALTER TABLE documenttype ADD CONSTRAINT FK_121FBC371FD4CEC9 FOREIGN KEY (type_data_id) REFERENCES type_data (id)');
        $this->addSql('CREATE INDEX IDX_121FBC371FD4CEC9 ON documenttype (type_data_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE type_data DROP FOREIGN KEY FK_7AFC366BC12E8CC4');
        $this->addSql('ALTER TABLE documenttype DROP FOREIGN KEY FK_121FBC371FD4CEC9');
        $this->addSql('DROP TABLE category_data');
        $this->addSql('DROP TABLE type_data');
        $this->addSql('DROP INDEX IDX_121FBC371FD4CEC9 ON documenttype');
        $this->addSql('ALTER TABLE documenttype DROP type_data_id');
    }
}
