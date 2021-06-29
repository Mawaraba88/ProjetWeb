<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210629121210 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category_donnees (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE documenttype (id INT AUTO_INCREMENT NOT NULL, donnees_type_id INT NOT NULL, categorydonnees_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, resume LONGTEXT NOT NULL, picture VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, start_created_at DATETIME DEFAULT NULL, end_created_at DATETIME DEFAULT NULL, place VARCHAR(255) DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, brochure_filename VARCHAR(255) DEFAULT NULL, INDEX IDX_121FBC37FBEBC999 (donnees_type_id), INDEX IDX_121FBC37C5290191 (categorydonnees_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE documenttype_users (documenttype_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_452BABA2821DDA76 (documenttype_id), INDEX IDX_452BABA267B3B43D (users_id), PRIMARY KEY(documenttype_id, users_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE donnees_type (id INT AUTO_INCREMENT NOT NULL, categorydonnees_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_13C8FFCEC5290191 (categorydonnees_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partners (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partners_users (partners_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_AB6DB3E6BDE7F1C6 (partners_id), INDEX IDX_AB6DB3E667B3B43D (users_id), PRIMARY KEY(partners_id, users_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, username VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, studylevel INT DEFAULT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE documenttype ADD CONSTRAINT FK_121FBC37FBEBC999 FOREIGN KEY (donnees_type_id) REFERENCES donnees_type (id)');
        $this->addSql('ALTER TABLE documenttype ADD CONSTRAINT FK_121FBC37C5290191 FOREIGN KEY (categorydonnees_id) REFERENCES category_donnees (id)');
        $this->addSql('ALTER TABLE documenttype_users ADD CONSTRAINT FK_452BABA2821DDA76 FOREIGN KEY (documenttype_id) REFERENCES documenttype (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE documenttype_users ADD CONSTRAINT FK_452BABA267B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE donnees_type ADD CONSTRAINT FK_13C8FFCEC5290191 FOREIGN KEY (categorydonnees_id) REFERENCES category_donnees (id)');
        $this->addSql('ALTER TABLE partners_users ADD CONSTRAINT FK_AB6DB3E6BDE7F1C6 FOREIGN KEY (partners_id) REFERENCES partners (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE partners_users ADD CONSTRAINT FK_AB6DB3E667B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE documenttype DROP FOREIGN KEY FK_121FBC37C5290191');
        $this->addSql('ALTER TABLE donnees_type DROP FOREIGN KEY FK_13C8FFCEC5290191');
        $this->addSql('ALTER TABLE documenttype_users DROP FOREIGN KEY FK_452BABA2821DDA76');
        $this->addSql('ALTER TABLE documenttype DROP FOREIGN KEY FK_121FBC37FBEBC999');
        $this->addSql('ALTER TABLE partners_users DROP FOREIGN KEY FK_AB6DB3E6BDE7F1C6');
        $this->addSql('ALTER TABLE documenttype_users DROP FOREIGN KEY FK_452BABA267B3B43D');
        $this->addSql('ALTER TABLE partners_users DROP FOREIGN KEY FK_AB6DB3E667B3B43D');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('DROP TABLE category_donnees');
        $this->addSql('DROP TABLE documenttype');
        $this->addSql('DROP TABLE documenttype_users');
        $this->addSql('DROP TABLE donnees_type');
        $this->addSql('DROP TABLE partners');
        $this->addSql('DROP TABLE partners_users');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE users');
    }
}
