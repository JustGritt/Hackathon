<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230330112100 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE hk_stat_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE hk_stat (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE hk_stat_user (hk_stat_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(hk_stat_id, user_id))');
        $this->addSql('CREATE INDEX IDX_24B32993E7B62294 ON hk_stat_user (hk_stat_id)');
        $this->addSql('CREATE INDEX IDX_24B32993A76ED395 ON hk_stat_user (user_id)');
        $this->addSql('CREATE TABLE hk_stat_hk_video (hk_stat_id INT NOT NULL, hk_video_id INT NOT NULL, PRIMARY KEY(hk_stat_id, hk_video_id))');
        $this->addSql('CREATE INDEX IDX_655FB995E7B62294 ON hk_stat_hk_video (hk_stat_id)');
        $this->addSql('CREATE INDEX IDX_655FB995499F6896 ON hk_stat_hk_video (hk_video_id)');
        $this->addSql('ALTER TABLE hk_stat_user ADD CONSTRAINT FK_24B32993E7B62294 FOREIGN KEY (hk_stat_id) REFERENCES hk_stat (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE hk_stat_user ADD CONSTRAINT FK_24B32993A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE hk_stat_hk_video ADD CONSTRAINT FK_655FB995E7B62294 FOREIGN KEY (hk_stat_id) REFERENCES hk_stat (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE hk_stat_hk_video ADD CONSTRAINT FK_655FB995499F6896 FOREIGN KEY (hk_video_id) REFERENCES hk_video (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE hk_stat_id_seq CASCADE');
        $this->addSql('ALTER TABLE hk_stat_user DROP CONSTRAINT FK_24B32993E7B62294');
        $this->addSql('ALTER TABLE hk_stat_user DROP CONSTRAINT FK_24B32993A76ED395');
        $this->addSql('ALTER TABLE hk_stat_hk_video DROP CONSTRAINT FK_655FB995E7B62294');
        $this->addSql('ALTER TABLE hk_stat_hk_video DROP CONSTRAINT FK_655FB995499F6896');
        $this->addSql('DROP TABLE hk_stat');
        $this->addSql('DROP TABLE hk_stat_user');
        $this->addSql('DROP TABLE hk_stat_hk_video');
    }
}
