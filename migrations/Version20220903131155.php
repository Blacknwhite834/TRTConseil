<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220903131155 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `admin` CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE email email VARCHAR(180) NOT NULL, CHANGE roles roles JSON NOT NULL, CHANGE password password VARCHAR(255) NOT NULL, CHANGE is_verified is_verified TINYINT(1) NOT NULL, CHANGE is_approved is_approved TINYINT(1) NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_880E0D76E7927C74 ON `admin` (email)');
        $this->addSql('ALTER TABLE annonce CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE title title VARCHAR(255) NOT NULL, CHANGE lieu lieu VARCHAR(255) NOT NULL, CHANGE description description VARCHAR(255) NOT NULL, CHANGE is_verified is_verified TINYINT(1) NOT NULL, CHANGE email email VARCHAR(255) NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE candidature CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE prenom prenom VARCHAR(255) NOT NULL, CHANGE cv cv VARCHAR(255) NOT NULL, CHANGE is_verified is_verified TINYINT(1) NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE candidature ADD CONSTRAINT FK_E33BD3B88805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id)');
        $this->addSql('CREATE INDEX IDX_E33BD3B88805AB2F ON candidature (annonce_id)');
        $this->addSql('ALTER TABLE consultant CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE email email VARCHAR(180) NOT NULL, CHANGE roles roles JSON NOT NULL, CHANGE password password VARCHAR(255) NOT NULL, CHANGE is_verified is_verified TINYINT(1) NOT NULL, CHANGE is_approved is_approved TINYINT(1) NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_441282A1E7927C74 ON consultant (email)');
        $this->addSql('ALTER TABLE profile_candidat CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE prenom prenom VARCHAR(255) NOT NULL, CHANGE cv cv VARCHAR(255) NOT NULL, CHANGE email_adress email_adress VARCHAR(255) NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE profile_recruteur CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE adresse adresse VARCHAR(255) NOT NULL, CHANGE email_adress email_adress VARCHAR(255) NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE user CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE email email VARCHAR(180) NOT NULL, CHANGE roles roles JSON NOT NULL, CHANGE password password VARCHAR(255) NOT NULL, CHANGE is_verified is_verified TINYINT(1) NOT NULL, CHANGE is_approved is_approved TINYINT(1) NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `admin` MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX UNIQ_880E0D76E7927C74 ON `admin`');
        $this->addSql('DROP INDEX `primary` ON `admin`');
        $this->addSql('ALTER TABLE `admin` CHANGE id id INT DEFAULT NULL, CHANGE email email TEXT DEFAULT NULL, CHANGE roles roles JSON DEFAULT NULL, CHANGE password password TEXT DEFAULT NULL, CHANGE is_verified is_verified INT DEFAULT NULL, CHANGE is_approved is_approved INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('DROP INDEX `primary` ON user');
        $this->addSql('ALTER TABLE user CHANGE id id INT DEFAULT NULL, CHANGE email email TEXT DEFAULT NULL, CHANGE roles roles JSON DEFAULT NULL, CHANGE password password TEXT DEFAULT NULL, CHANGE is_verified is_verified INT DEFAULT NULL, CHANGE is_approved is_approved INT DEFAULT NULL');
        $this->addSql('ALTER TABLE profile_recruteur MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON profile_recruteur');
        $this->addSql('ALTER TABLE profile_recruteur CHANGE id id INT DEFAULT NULL, CHANGE nom nom TEXT DEFAULT NULL, CHANGE adresse adresse TEXT DEFAULT NULL, CHANGE email_adress email_adress TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE profile_candidat MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON profile_candidat');
        $this->addSql('ALTER TABLE profile_candidat CHANGE id id INT DEFAULT NULL, CHANGE nom nom TEXT DEFAULT NULL, CHANGE prenom prenom TEXT DEFAULT NULL, CHANGE cv cv TEXT DEFAULT NULL, CHANGE email_adress email_adress TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE annonce MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON annonce');
        $this->addSql('ALTER TABLE annonce CHANGE id id INT DEFAULT NULL, CHANGE title title TEXT DEFAULT NULL, CHANGE lieu lieu TEXT DEFAULT NULL, CHANGE description description TEXT DEFAULT NULL, CHANGE is_verified is_verified INT DEFAULT NULL, CHANGE email email TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE consultant MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX UNIQ_441282A1E7927C74 ON consultant');
        $this->addSql('DROP INDEX `primary` ON consultant');
        $this->addSql('ALTER TABLE consultant CHANGE id id INT DEFAULT NULL, CHANGE email email TEXT DEFAULT NULL, CHANGE roles roles JSON DEFAULT NULL, CHANGE password password TEXT DEFAULT NULL, CHANGE is_verified is_verified INT DEFAULT NULL, CHANGE is_approved is_approved INT DEFAULT NULL');
        $this->addSql('ALTER TABLE candidature MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE candidature DROP FOREIGN KEY FK_E33BD3B88805AB2F');
        $this->addSql('DROP INDEX IDX_E33BD3B88805AB2F ON candidature');
        $this->addSql('DROP INDEX `primary` ON candidature');
        $this->addSql('ALTER TABLE candidature CHANGE id id INT DEFAULT NULL, CHANGE nom nom TEXT DEFAULT NULL, CHANGE prenom prenom TEXT DEFAULT NULL, CHANGE cv cv TEXT DEFAULT NULL, CHANGE is_verified is_verified INT DEFAULT NULL');
    }
}
