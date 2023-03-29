<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230328141047 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category ADD min_age INT DEFAULT NULL');
        $this->addSql('ALTER TABLE category ADD max_age INT DEFAULT NULL');
        $this->addSql('ALTER TABLE category DROP age_group');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE category ADD age_group TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE category DROP min_age');
        $this->addSql('ALTER TABLE category DROP max_age');
        $this->addSql('COMMENT ON COLUMN category.age_group IS \'(DC2Type:array)\'');
    }
}
