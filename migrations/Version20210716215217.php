<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210716215217 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category_news (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news (id INT AUTO_INCREMENT NOT NULL, categorynews_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, resume LONGTEXT DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, start_created_at DATETIME DEFAULT NULL, end_created_at DATETIME DEFAULT NULL, place VARCHAR(255) DEFAULT NULL, brochure_file_name VARCHAR(255) DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, INDEX IDX_1DD39950437F7458 (categorynews_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news_users (news_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_6E3C22B7B5A459A0 (news_id), INDEX IDX_6E3C22B767B3B43D (users_id), PRIMARY KEY(news_id, users_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE news ADD CONSTRAINT FK_1DD39950437F7458 FOREIGN KEY (categorynews_id) REFERENCES category_news (id)');
        $this->addSql('ALTER TABLE news_users ADD CONSTRAINT FK_6E3C22B7B5A459A0 FOREIGN KEY (news_id) REFERENCES news (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE news_users ADD CONSTRAINT FK_6E3C22B767B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE news DROP FOREIGN KEY FK_1DD39950437F7458');
        $this->addSql('ALTER TABLE news_users DROP FOREIGN KEY FK_6E3C22B7B5A459A0');
        $this->addSql('DROP TABLE category_news');
        $this->addSql('DROP TABLE news');
        $this->addSql('DROP TABLE news_users');
    }
}
