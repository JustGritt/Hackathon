<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230330091453 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comments_quiz (id INT NOT NULL, quiz_id INT DEFAULT NULL, reason VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_20C3D735853CD175 ON comments_quiz (quiz_id)');
        $this->addSql('CREATE TABLE question (id INT NOT NULL, content VARCHAR(150) NOT NULL, image VARCHAR(255) NOT NULL, is_response BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE question_has_quiz (id INT NOT NULL, quiz_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9A4691C1853CD175 ON question_has_quiz (quiz_id)');
        $this->addSql('CREATE TABLE quiz (id INT NOT NULL, category_id INT NOT NULL, created_by_id INT NOT NULL, name VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, is_active BOOLEAN NOT NULL, is_draft BOOLEAN NOT NULL, is_published BOOLEAN NOT NULL, is_waiting BOOLEAN NOT NULL, is_refused BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A412FA9212469DE2 ON quiz (category_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A412FA92B03A8386 ON quiz (created_by_id)');
        $this->addSql('CREATE TABLE quiz_made (id INT NOT NULL, quiz_id INT NOT NULL, user_id_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_57A596FA853CD175 ON quiz_made (quiz_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_57A596FA9D86650F ON quiz_made (user_id_id)');
        $this->addSql('ALTER TABLE comments_quiz ADD CONSTRAINT FK_20C3D735853CD175 FOREIGN KEY (quiz_id) REFERENCES quiz (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE question_has_quiz ADD CONSTRAINT FK_9A4691C1853CD175 FOREIGN KEY (quiz_id) REFERENCES quiz (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quiz ADD CONSTRAINT FK_A412FA9212469DE2 FOREIGN KEY (category_id) REFERENCES category (id) DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quiz ADD CONSTRAINT FK_A412FA92B03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quiz_made ADD CONSTRAINT FK_57A596FA853CD175 FOREIGN KEY (quiz_id) REFERENCES quiz (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quiz_made ADD CONSTRAINT FK_57A596FA9D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE comments_quiz DROP CONSTRAINT FK_20C3D735853CD175');
        $this->addSql('ALTER TABLE question_has_quiz DROP CONSTRAINT FK_9A4691C1853CD175');
        $this->addSql('ALTER TABLE quiz DROP CONSTRAINT FK_A412FA9212469DE2');
        $this->addSql('ALTER TABLE quiz DROP CONSTRAINT FK_A412FA92B03A8386');
        $this->addSql('ALTER TABLE quiz_made DROP CONSTRAINT FK_57A596FA853CD175');
        $this->addSql('ALTER TABLE quiz_made DROP CONSTRAINT FK_57A596FA9D86650F');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE comments_quiz');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE question_has_quiz');
        $this->addSql('DROP TABLE quiz');
        $this->addSql('DROP TABLE quiz_made');
    }
}