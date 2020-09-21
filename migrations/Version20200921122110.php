<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200921122110 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_platform (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, url VARCHAR(255) DEFAULT NULL, username VARCHAR(255) DEFAULT NULL, INDEX IDX_D9DF34CBA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_platform_platform (user_platform_id INT NOT NULL, platform_id INT NOT NULL, INDEX IDX_443D6BF256FD80FA (user_platform_id), INDEX IDX_443D6BF2FFE6496F (platform_id), PRIMARY KEY(user_platform_id, platform_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_platform ADD CONSTRAINT FK_D9DF34CBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_platform_platform ADD CONSTRAINT FK_443D6BF256FD80FA FOREIGN KEY (user_platform_id) REFERENCES user_platform (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_platform_platform ADD CONSTRAINT FK_443D6BF2FFE6496F FOREIGN KEY (platform_id) REFERENCES platform (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_platform_platform DROP FOREIGN KEY FK_443D6BF256FD80FA');
        $this->addSql('DROP TABLE user_platform');
        $this->addSql('DROP TABLE user_platform_platform');
    }
}
