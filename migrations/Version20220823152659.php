<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220823152659 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE annonce_candidature');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annonce_candidature (annonce_id INT NOT NULL, candidature_id INT NOT NULL, INDEX IDX_979475F78805AB2F (annonce_id), INDEX IDX_979475F7B6121583 (candidature_id), PRIMARY KEY(annonce_id, candidature_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE annonce_candidature ADD CONSTRAINT FK_979475F78805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE annonce_candidature ADD CONSTRAINT FK_979475F7B6121583 FOREIGN KEY (candidature_id) REFERENCES candidature (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
