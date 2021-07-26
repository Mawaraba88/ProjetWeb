<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210722225543 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category_donnees (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_news (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE documenttype (id INT AUTO_INCREMENT NOT NULL, categorydonnees_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, resume LONGTEXT NOT NULL, picture VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, update_at DATETIME NOT NULL, is_active TINYINT(1) DEFAULT NULL, brochure_filename VARCHAR(255) NOT NULL, INDEX IDX_121FBC37C5290191 (categorydonnees_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE documenttype_user (documenttype_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_FB9DA778821DDA76 (documenttype_id), INDEX IDX_FB9DA778A76ED395 (user_id), PRIMARY KEY(documenttype_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news (id INT AUTO_INCREMENT NOT NULL, categorynews_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, resume LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, start_created_at DATETIME DEFAULT NULL, end_created_at DATETIME DEFAULT NULL, place VARCHAR(255) DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, update_at DATETIME NOT NULL, duration_of_publication INT DEFAULT NULL, INDEX IDX_1DD39950437F7458 (categorynews_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news_user (news_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_584E20C2B5A459A0 (news_id), INDEX IDX_584E20C2A76ED395 (user_id), PRIMARY KEY(news_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partners (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partners_user (partners_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_B3E4CF7ABDE7F1C6 (partners_id), INDEX IDX_B3E4CF7AA76ED395 (user_id), PRIMARY KEY(partners_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, username VARCHAR(255) DEFAULT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, is_valide TINYINT(1) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, field_of_research VARCHAR(255) DEFAULT NULL, place VARCHAR(255) DEFAULT NULL, studylevel VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE documenttype ADD CONSTRAINT FK_121FBC37C5290191 FOREIGN KEY (categorydonnees_id) REFERENCES category_donnees (id)');
        $this->addSql('ALTER TABLE documenttype_user ADD CONSTRAINT FK_FB9DA778821DDA76 FOREIGN KEY (documenttype_id) REFERENCES documenttype (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE documenttype_user ADD CONSTRAINT FK_FB9DA778A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE news ADD CONSTRAINT FK_1DD39950437F7458 FOREIGN KEY (categorynews_id) REFERENCES category_news (id)');
        $this->addSql('ALTER TABLE news_user ADD CONSTRAINT FK_584E20C2B5A459A0 FOREIGN KEY (news_id) REFERENCES news (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE news_user ADD CONSTRAINT FK_584E20C2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE partners_user ADD CONSTRAINT FK_B3E4CF7ABDE7F1C6 FOREIGN KEY (partners_id) REFERENCES partners (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE partners_user ADD CONSTRAINT FK_B3E4CF7AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE documenttype DROP FOREIGN KEY FK_121FBC37C5290191');
        $this->addSql('ALTER TABLE news DROP FOREIGN KEY FK_1DD39950437F7458');
        $this->addSql('ALTER TABLE documenttype_user DROP FOREIGN KEY FK_FB9DA778821DDA76');
        $this->addSql('ALTER TABLE news_user DROP FOREIGN KEY FK_584E20C2B5A459A0');
        $this->addSql('ALTER TABLE partners_user DROP FOREIGN KEY FK_B3E4CF7ABDE7F1C6');
        $this->addSql('ALTER TABLE documenttype_user DROP FOREIGN KEY FK_FB9DA778A76ED395');
        $this->addSql('ALTER TABLE news_user DROP FOREIGN KEY FK_584E20C2A76ED395');
        $this->addSql('ALTER TABLE partners_user DROP FOREIGN KEY FK_B3E4CF7AA76ED395');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('DROP TABLE category_donnees');
        $this->addSql('DROP TABLE category_news');
        $this->addSql('DROP TABLE documenttype');
        $this->addSql('DROP TABLE documenttype_user');
        $this->addSql('DROP TABLE news');
        $this->addSql('DROP TABLE news_user');
        $this->addSql('DROP TABLE partners');
        $this->addSql('DROP TABLE partners_user');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE user');
    }
}
