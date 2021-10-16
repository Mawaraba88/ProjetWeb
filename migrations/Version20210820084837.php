<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210820084837 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_partners (user_id INT NOT NULL, partners_id INT NOT NULL, INDEX IDX_F66B564A76ED395 (user_id), INDEX IDX_F66B564BDE7F1C6 (partners_id), PRIMARY KEY(user_id, partners_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_partners ADD CONSTRAINT FK_F66B564A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_partners ADD CONSTRAINT FK_F66B564BDE7F1C6 FOREIGN KEY (partners_id) REFERENCES partners (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE partners_user');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE partners_user (partners_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_B3E4CF7AA76ED395 (user_id), INDEX IDX_B3E4CF7ABDE7F1C6 (partners_id), PRIMARY KEY(partners_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE partners_user ADD CONSTRAINT FK_B3E4CF7AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE partners_user ADD CONSTRAINT FK_B3E4CF7ABDE7F1C6 FOREIGN KEY (partners_id) REFERENCES partners (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE user_partners');
    }
}
