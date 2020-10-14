<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201014140355 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rate_game ADD game_id INT NOT NULL');
        $this->addSql('ALTER TABLE rate_game ADD CONSTRAINT FK_DC2F8383E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DC2F8383E48FD905 ON rate_game (game_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rate_game DROP FOREIGN KEY FK_DC2F8383E48FD905');
        $this->addSql('DROP INDEX UNIQ_DC2F8383E48FD905 ON rate_game');
        $this->addSql('ALTER TABLE rate_game DROP game_id');
    }
}
