<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230330151042 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hk_video ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE hk_video ADD CONSTRAINT FK_A8A0EB6B12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_A8A0EB6B12469DE2 ON hk_video (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE hk_video DROP CONSTRAINT FK_A8A0EB6B12469DE2');
        $this->addSql('DROP INDEX IDX_A8A0EB6B12469DE2');
        $this->addSql('ALTER TABLE hk_video DROP category_id');
    }
}
