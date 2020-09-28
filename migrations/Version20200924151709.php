<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200924151709 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_platform (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, steam VARCHAR(255) DEFAULT NULL, facebook VARCHAR(255) DEFAULT NULL, battlenet VARCHAR(255) DEFAULT NULL, gog VARCHAR(255) DEFAULT NULL, instagram VARCHAR(255) DEFAULT NULL, lol VARCHAR(255) DEFAULT NULL, nintendo VARCHAR(255) DEFAULT NULL, origin VARCHAR(255) DEFAULT NULL, psn VARCHAR(255) DEFAULT NULL, rockstar VARCHAR(255) DEFAULT NULL, skype VARCHAR(255) DEFAULT NULL, snapchat VARCHAR(255) DEFAULT NULL, twitch VARCHAR(255) DEFAULT NULL, twitter VARCHAR(255) DEFAULT NULL, ubisoft VARCHAR(255) DEFAULT NULL, wargaming VARCHAR(255) DEFAULT NULL, xbox VARCHAR(255) DEFAULT NULL, youtube VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_D9DF34CBA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_platform ADD CONSTRAINT FK_D9DF34CBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user_platform');
    }
}
