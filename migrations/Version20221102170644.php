<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221102170644 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profile_recruteur ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE profile_recruteur ADD CONSTRAINT FK_974C8EF7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_974C8EF7A76ED395 ON profile_recruteur (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profile_recruteur DROP FOREIGN KEY FK_974C8EF7A76ED395');
        $this->addSql('DROP INDEX UNIQ_974C8EF7A76ED395 ON profile_recruteur');
        $this->addSql('ALTER TABLE profile_recruteur DROP user_id');
    }
}
