<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230123115442 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE skill_group (id INT AUTO_INCREMENT NOT NULL, lang_id INT NOT NULL, name VARCHAR(255) NOT NULL, weight INT DEFAULT NULL, INDEX IDX_48E8D7F9B213FA4 (lang_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE skill_group ADD CONSTRAINT FK_48E8D7F9B213FA4 FOREIGN KEY (lang_id) REFERENCES lang (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE skill_group DROP FOREIGN KEY FK_48E8D7F9B213FA4');
        $this->addSql('DROP TABLE skill_group');
    }
}
