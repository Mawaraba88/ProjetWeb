<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210628171602 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE document_documenttype (document_id INT NOT NULL, documenttype_id INT NOT NULL, INDEX IDX_BFFA9D46C33F7837 (document_id), INDEX IDX_BFFA9D46821DDA76 (documenttype_id), PRIMARY KEY(document_id, documenttype_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE document_documenttype ADD CONSTRAINT FK_BFFA9D46C33F7837 FOREIGN KEY (document_id) REFERENCES Document (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE document_documenttype ADD CONSTRAINT FK_BFFA9D46821DDA76 FOREIGN KEY (documenttype_id) REFERENCES documenttype (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE document_documenttype');
    }
}
