<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230331132201 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE answer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE commentaire_video_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE comments_quiz_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE hk_stat_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE hk_video_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE question_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE question_has_quiz_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE quiz_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE quiz_made_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE reset_password_request_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE answer (id INT NOT NULL, question_id INT NOT NULL, content VARCHAR(255) NOT NULL, is_response BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DADD4A251E27F6BF ON answer (question_id)');
        $this->addSql('CREATE TABLE category (id INT NOT NULL, owner_id INT DEFAULT NULL, name VARCHAR(65) NOT NULL, is_active BOOLEAN NOT NULL, min_age INT DEFAULT NULL, max_age INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_64C19C17E3C61F9 ON category (owner_id)');
        $this->addSql('CREATE TABLE commentaire_video (id INT NOT NULL, user_id_id INT DEFAULT NULL, video_id_id INT DEFAULT NULL, commentaire VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F94B12309D86650F ON commentaire_video (user_id_id)');
        $this->addSql('CREATE INDEX IDX_F94B1230F02697F5 ON commentaire_video (video_id_id)');
        $this->addSql('CREATE TABLE comments_quiz (id INT NOT NULL, quiz_id INT DEFAULT NULL, reason VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_20C3D735853CD175 ON comments_quiz (quiz_id)');
        $this->addSql('CREATE TABLE hk_stat (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE hk_stat_user (hk_stat_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(hk_stat_id, user_id))');
        $this->addSql('CREATE INDEX IDX_24B32993E7B62294 ON hk_stat_user (hk_stat_id)');
        $this->addSql('CREATE INDEX IDX_24B32993A76ED395 ON hk_stat_user (user_id)');
        $this->addSql('CREATE TABLE hk_stat_hk_video (hk_stat_id INT NOT NULL, hk_video_id INT NOT NULL, PRIMARY KEY(hk_stat_id, hk_video_id))');
        $this->addSql('CREATE INDEX IDX_655FB995E7B62294 ON hk_stat_hk_video (hk_stat_id)');
        $this->addSql('CREATE INDEX IDX_655FB995499F6896 ON hk_stat_hk_video (hk_video_id)');
        $this->addSql('CREATE TABLE hk_video (id INT NOT NULL, category_id INT DEFAULT NULL, link VARCHAR(255) NOT NULL, active BOOLEAN NOT NULL, description VARCHAR(255) NOT NULL, waiting BOOLEAN NOT NULL, publish BOOLEAN NOT NULL, refused BOOLEAN NOT NULL, title VARCHAR(128) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A8A0EB6B12469DE2 ON hk_video (category_id)');
        $this->addSql('CREATE TABLE question (id INT NOT NULL, quiz_id INT NOT NULL, content VARCHAR(150) NOT NULL, image VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B6F7494E853CD175 ON question (quiz_id)');
        $this->addSql('CREATE TABLE question_has_quiz (id INT NOT NULL, quiz_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9A4691C1853CD175 ON question_has_quiz (quiz_id)');
        $this->addSql('CREATE TABLE quiz (id INT NOT NULL, created_by_id INT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, is_active BOOLEAN NOT NULL, is_draft BOOLEAN NOT NULL, is_published BOOLEAN NOT NULL, is_waiting BOOLEAN NOT NULL, is_refused BOOLEAN NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A412FA92B03A8386 ON quiz (created_by_id)');
        $this->addSql('CREATE INDEX IDX_A412FA9212469DE2 ON quiz (category_id)');
        $this->addSql('CREATE TABLE quiz_made (id INT NOT NULL, quiz_id INT NOT NULL, user_id_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_57A596FA853CD175 ON quiz_made (quiz_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_57A596FA9D86650F ON quiz_made (user_id_id)');
        $this->addSql('CREATE TABLE reset_password_request (id INT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, expires_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7CE748AA76ED395 ON reset_password_request (user_id)');
        $this->addSql('COMMENT ON COLUMN reset_password_request.requested_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN reset_password_request.expires_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, auth_code VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, is_verified BOOLEAN NOT NULL, firstname VARCHAR(65) NOT NULL, lastname VARCHAR(128) NOT NULL, bithdate DATE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A251E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C17E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commentaire_video ADD CONSTRAINT FK_F94B12309D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commentaire_video ADD CONSTRAINT FK_F94B1230F02697F5 FOREIGN KEY (video_id_id) REFERENCES hk_video (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comments_quiz ADD CONSTRAINT FK_20C3D735853CD175 FOREIGN KEY (quiz_id) REFERENCES quiz (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE hk_stat_user ADD CONSTRAINT FK_24B32993E7B62294 FOREIGN KEY (hk_stat_id) REFERENCES hk_stat (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE hk_stat_user ADD CONSTRAINT FK_24B32993A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE hk_stat_hk_video ADD CONSTRAINT FK_655FB995E7B62294 FOREIGN KEY (hk_stat_id) REFERENCES hk_stat (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE hk_stat_hk_video ADD CONSTRAINT FK_655FB995499F6896 FOREIGN KEY (hk_video_id) REFERENCES hk_video (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE hk_video ADD CONSTRAINT FK_A8A0EB6B12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E853CD175 FOREIGN KEY (quiz_id) REFERENCES quiz (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE question_has_quiz ADD CONSTRAINT FK_9A4691C1853CD175 FOREIGN KEY (quiz_id) REFERENCES quiz (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quiz ADD CONSTRAINT FK_A412FA92B03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quiz ADD CONSTRAINT FK_A412FA9212469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quiz_made ADD CONSTRAINT FK_57A596FA853CD175 FOREIGN KEY (quiz_id) REFERENCES quiz (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quiz_made ADD CONSTRAINT FK_57A596FA9D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE answer_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE commentaire_video_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE comments_quiz_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE hk_stat_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE hk_video_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE question_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE question_has_quiz_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE quiz_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE quiz_made_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE reset_password_request_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('ALTER TABLE answer DROP CONSTRAINT FK_DADD4A251E27F6BF');
        $this->addSql('ALTER TABLE category DROP CONSTRAINT FK_64C19C17E3C61F9');
        $this->addSql('ALTER TABLE commentaire_video DROP CONSTRAINT FK_F94B12309D86650F');
        $this->addSql('ALTER TABLE commentaire_video DROP CONSTRAINT FK_F94B1230F02697F5');
        $this->addSql('ALTER TABLE comments_quiz DROP CONSTRAINT FK_20C3D735853CD175');
        $this->addSql('ALTER TABLE hk_stat_user DROP CONSTRAINT FK_24B32993E7B62294');
        $this->addSql('ALTER TABLE hk_stat_user DROP CONSTRAINT FK_24B32993A76ED395');
        $this->addSql('ALTER TABLE hk_stat_hk_video DROP CONSTRAINT FK_655FB995E7B62294');
        $this->addSql('ALTER TABLE hk_stat_hk_video DROP CONSTRAINT FK_655FB995499F6896');
        $this->addSql('ALTER TABLE hk_video DROP CONSTRAINT FK_A8A0EB6B12469DE2');
        $this->addSql('ALTER TABLE question DROP CONSTRAINT FK_B6F7494E853CD175');
        $this->addSql('ALTER TABLE question_has_quiz DROP CONSTRAINT FK_9A4691C1853CD175');
        $this->addSql('ALTER TABLE quiz DROP CONSTRAINT FK_A412FA92B03A8386');
        $this->addSql('ALTER TABLE quiz DROP CONSTRAINT FK_A412FA9212469DE2');
        $this->addSql('ALTER TABLE quiz_made DROP CONSTRAINT FK_57A596FA853CD175');
        $this->addSql('ALTER TABLE quiz_made DROP CONSTRAINT FK_57A596FA9D86650F');
        $this->addSql('ALTER TABLE reset_password_request DROP CONSTRAINT FK_7CE748AA76ED395');
        $this->addSql('DROP TABLE answer');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE commentaire_video');
        $this->addSql('DROP TABLE comments_quiz');
        $this->addSql('DROP TABLE hk_stat');
        $this->addSql('DROP TABLE hk_stat_user');
        $this->addSql('DROP TABLE hk_stat_hk_video');
        $this->addSql('DROP TABLE hk_video');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE question_has_quiz');
        $this->addSql('DROP TABLE quiz');
        $this->addSql('DROP TABLE quiz_made');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
