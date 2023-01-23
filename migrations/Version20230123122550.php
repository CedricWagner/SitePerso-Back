<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230123122550 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE skill ADD lang_id INT NOT NULL');
        $this->addSql('ALTER TABLE skill ADD CONSTRAINT FK_5E3DE477B213FA4 FOREIGN KEY (lang_id) REFERENCES lang (id)');
        $this->addSql('CREATE INDEX IDX_5E3DE477B213FA4 ON skill (lang_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE skill DROP FOREIGN KEY FK_5E3DE477B213FA4');
        $this->addSql('DROP INDEX IDX_5E3DE477B213FA4 ON skill');
        $this->addSql('ALTER TABLE skill DROP lang_id');
    }
}
