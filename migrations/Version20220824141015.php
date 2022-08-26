<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220824141015 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profile_candidat DROP is_approved');
        $this->addSql('ALTER TABLE profile_recruteur DROP is_approved');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profile_candidat ADD is_approved TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE profile_recruteur ADD is_approved TINYINT(1) NOT NULL');
    }
}
