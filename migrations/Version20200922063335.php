<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200922063335 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_config (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, cpu VARCHAR(255) DEFAULT NULL, graphic_card VARCHAR(255) DEFAULT NULL, ram VARCHAR(255) DEFAULT NULL, screen VARCHAR(255) DEFAULT NULL, mouse VARCHAR(255) DEFAULT NULL, keyboard VARCHAR(255) DEFAULT NULL, consoles LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', motherboard VARCHAR(255) DEFAULT NULL, power VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_B1D83441A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_config ADD CONSTRAINT FK_B1D83441A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('DROP TABLE availability');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE availability (id INT AUTO_INCREMENT NOT NULL, morning TINYINT(1) DEFAULT NULL, midday TINYINT(1) DEFAULT NULL, evening TINYINT(1) DEFAULT NULL, night TINYINT(1) DEFAULT NULL, day VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE user_config');
    }
}
