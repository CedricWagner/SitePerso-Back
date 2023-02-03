<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230203122653 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE profile_information (id INT AUTO_INCREMENT NOT NULL, slug VARCHAR(127) NOT NULL, value VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile_information_lang (profile_information_id INT NOT NULL, lang_id INT NOT NULL, INDEX IDX_CB770207B5BAF014 (profile_information_id), INDEX IDX_CB770207B213FA4 (lang_id), PRIMARY KEY(profile_information_id, lang_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE profile_information_lang ADD CONSTRAINT FK_CB770207B5BAF014 FOREIGN KEY (profile_information_id) REFERENCES profile_information (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE profile_information_lang ADD CONSTRAINT FK_CB770207B213FA4 FOREIGN KEY (lang_id) REFERENCES lang (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profile_information_lang DROP FOREIGN KEY FK_CB770207B5BAF014');
        $this->addSql('ALTER TABLE profile_information_lang DROP FOREIGN KEY FK_CB770207B213FA4');
        $this->addSql('DROP TABLE profile_information');
        $this->addSql('DROP TABLE profile_information_lang');
    }
}
