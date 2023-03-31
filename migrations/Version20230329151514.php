<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230329151514 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
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