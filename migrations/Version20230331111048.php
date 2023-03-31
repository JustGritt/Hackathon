<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230331111048 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comments_quiz ADD CONSTRAINT FK_20C3D735853CD175 FOREIGN KEY (quiz_id) REFERENCES quiz (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE question ADD image VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE quiz ADD image VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE quiz ADD is_active BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE quiz ADD is_draft BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE quiz ADD is_published BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE quiz ADD is_waiting BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE quiz ADD is_refused BOOLEAN NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE quiz DROP image');
        $this->addSql('ALTER TABLE quiz DROP is_active');
        $this->addSql('ALTER TABLE quiz DROP is_draft');
        $this->addSql('ALTER TABLE quiz DROP is_published');
        $this->addSql('ALTER TABLE quiz DROP is_waiting');
        $this->addSql('ALTER TABLE quiz DROP is_refused');
        $this->addSql('ALTER TABLE comments_quiz DROP CONSTRAINT FK_20C3D735853CD175');
        $this->addSql('ALTER TABLE question DROP image');
    }
}
