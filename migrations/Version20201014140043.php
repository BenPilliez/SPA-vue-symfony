<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201014140043 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game ADD rates_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C877DAA6F FOREIGN KEY (rates_id) REFERENCES rate_game (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_232B318C877DAA6F ON game (rates_id)');
        $this->addSql('ALTER TABLE rate_game DROP game_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C877DAA6F');
        $this->addSql('DROP INDEX UNIQ_232B318C877DAA6F ON game');
        $this->addSql('ALTER TABLE game DROP rates_id');
        $this->addSql('ALTER TABLE rate_game ADD game_id INT NOT NULL');
    }
}
