<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221102165201 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profile_candidat ADD user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE profile_candidat ADD CONSTRAINT FK_93DFD5C09D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_93DFD5C09D86650F ON profile_candidat (user_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profile_candidat DROP FOREIGN KEY FK_93DFD5C09D86650F');
        $this->addSql('DROP INDEX UNIQ_93DFD5C09D86650F ON profile_candidat');
        $this->addSql('ALTER TABLE profile_candidat DROP user_id_id');
    }
}
