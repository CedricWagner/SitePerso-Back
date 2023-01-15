<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230115141103 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE text_block ADD lang_id INT NOT NULL');
        $this->addSql('ALTER TABLE text_block ADD CONSTRAINT FK_D5AF2D7FB213FA4 FOREIGN KEY (lang_id) REFERENCES lang (id)');
        $this->addSql('CREATE INDEX IDX_D5AF2D7FB213FA4 ON text_block (lang_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE text_block DROP FOREIGN KEY FK_D5AF2D7FB213FA4');
        $this->addSql('DROP INDEX IDX_D5AF2D7FB213FA4 ON text_block');
        $this->addSql('ALTER TABLE text_block DROP lang_id');
    }
}
