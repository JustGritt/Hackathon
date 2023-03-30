<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230330100935 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX uniq_a412fa92b03a8386');
        $this->addSql('DROP INDEX uniq_a412fa9212469de2');
        $this->addSql('CREATE INDEX IDX_A412FA92B03A8386 ON quiz (created_by_id)');
        $this->addSql('CREATE INDEX IDX_A412FA9212469DE2 ON quiz (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX IDX_A412FA92B03A8386');
        $this->addSql('DROP INDEX IDX_A412FA9212469DE2');
        $this->addSql('CREATE UNIQUE INDEX uniq_a412fa92b03a8386 ON quiz (created_by_id)');
        $this->addSql('CREATE UNIQUE INDEX uniq_a412fa9212469de2 ON quiz (category_id)');
    }
}
