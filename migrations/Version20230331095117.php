<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230331095117 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        //$this->addSql('CREATE SEQUENCE commentaire_video_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        //$this->addSql('CREATE SEQUENCE hk_video_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE commentaire_video ALTER user_id_id DROP NOT NULL');
        $this->addSql('ALTER TABLE commentaire_video ALTER video_id_id DROP NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE commentaire_video_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE hk_video_id_seq CASCADE');
        $this->addSql('ALTER TABLE commentaire_video ALTER user_id_id SET NOT NULL');
        $this->addSql('ALTER TABLE commentaire_video ALTER video_id_id SET NOT NULL');
    }
}
