<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220729134930 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profile_recruteur ADD email_adress_id INT NOT NULL');
        $this->addSql('ALTER TABLE profile_recruteur ADD CONSTRAINT FK_974C8EF78B8D6687 FOREIGN KEY (email_adress_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_974C8EF78B8D6687 ON profile_recruteur (email_adress_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profile_recruteur DROP FOREIGN KEY FK_974C8EF78B8D6687');
        $this->addSql('DROP INDEX UNIQ_974C8EF78B8D6687 ON profile_recruteur');
        $this->addSql('ALTER TABLE profile_recruteur DROP email_adress_id');
    }
}
