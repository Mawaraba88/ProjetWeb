<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210722213721 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE documenttype_user (documenttype_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_FB9DA778821DDA76 (documenttype_id), INDEX IDX_FB9DA778A76ED395 (user_id), PRIMARY KEY(documenttype_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news_user (news_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_584E20C2B5A459A0 (news_id), INDEX IDX_584E20C2A76ED395 (user_id), PRIMARY KEY(news_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partners_user (partners_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_B3E4CF7ABDE7F1C6 (partners_id), INDEX IDX_B3E4CF7AA76ED395 (user_id), PRIMARY KEY(partners_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE documenttype_user ADD CONSTRAINT FK_FB9DA778821DDA76 FOREIGN KEY (documenttype_id) REFERENCES documenttype (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE documenttype_user ADD CONSTRAINT FK_FB9DA778A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE news_user ADD CONSTRAINT FK_584E20C2B5A459A0 FOREIGN KEY (news_id) REFERENCES news (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE news_user ADD CONSTRAINT FK_584E20C2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE partners_user ADD CONSTRAINT FK_B3E4CF7ABDE7F1C6 FOREIGN KEY (partners_id) REFERENCES partners (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE partners_user ADD CONSTRAINT FK_B3E4CF7AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE documenttype_users');
        $this->addSql('DROP TABLE news_users');
        $this->addSql('DROP TABLE partners_users');
        $this->addSql('ALTER TABLE user ADD studylevel VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE documenttype_users (documenttype_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_452BABA2821DDA76 (documenttype_id), INDEX IDX_452BABA267B3B43D (users_id), PRIMARY KEY(documenttype_id, users_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE news_users (news_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_6E3C22B7B5A459A0 (news_id), INDEX IDX_6E3C22B767B3B43D (users_id), PRIMARY KEY(news_id, users_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE partners_users (partners_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_AB6DB3E6BDE7F1C6 (partners_id), INDEX IDX_AB6DB3E667B3B43D (users_id), PRIMARY KEY(partners_id, users_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE documenttype_users ADD CONSTRAINT FK_452BABA267B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE documenttype_users ADD CONSTRAINT FK_452BABA2821DDA76 FOREIGN KEY (documenttype_id) REFERENCES documenttype (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE news_users ADD CONSTRAINT FK_6E3C22B767B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE news_users ADD CONSTRAINT FK_6E3C22B7B5A459A0 FOREIGN KEY (news_id) REFERENCES news (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE partners_users ADD CONSTRAINT FK_AB6DB3E667B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE partners_users ADD CONSTRAINT FK_AB6DB3E6BDE7F1C6 FOREIGN KEY (partners_id) REFERENCES partners (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE documenttype_user');
        $this->addSql('DROP TABLE news_user');
        $this->addSql('DROP TABLE partners_user');
        $this->addSql('ALTER TABLE user DROP studylevel');
    }
}
