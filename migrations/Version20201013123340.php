<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201013123340 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rate_game (id INT AUTO_INCREMENT NOT NULL, nb_rate INT NOT NULL, rate NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game ADD rates_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C877DAA6F FOREIGN KEY (rates_id) REFERENCES rate_game (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_232B318C877DAA6F ON game (rates_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C877DAA6F');
        $this->addSql('DROP TABLE rate_game');
        $this->addSql('DROP INDEX UNIQ_232B318C877DAA6F ON game');
        $this->addSql('ALTER TABLE game DROP rates_id');
    }
}
