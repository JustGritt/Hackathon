<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230329133746 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commentaire_video (id INT NOT NULL, user_id_id INT NOT NULL, video_id_id INT NOT NULL, commentaire VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F94B12309D86650F ON commentaire_video (user_id_id)');
        $this->addSql('CREATE INDEX IDX_F94B1230F02697F5 ON commentaire_video (video_id_id)');
        $this->addSql('CREATE TABLE hk_video (id INT NOT NULL, link VARCHAR(255) NOT NULL, active BOOLEAN NOT NULL, description VARCHAR(255) NOT NULL, waiting BOOLEAN NOT NULL, publish BOOLEAN NOT NULL, refused BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE commentaire_video ADD CONSTRAINT FK_F94B12309D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commentaire_video ADD CONSTRAINT FK_F94B1230F02697F5 FOREIGN KEY (video_id_id) REFERENCES hk_video (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE commentaire_video DROP CONSTRAINT FK_F94B12309D86650F');
        $this->addSql('ALTER TABLE commentaire_video DROP CONSTRAINT FK_F94B1230F02697F5');
        $this->addSql('DROP TABLE commentaire_video');
        $this->addSql('DROP TABLE hk_video');
    }
}
