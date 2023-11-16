<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231116145448 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("CREATE TABLE IF NOT EXISTS user(id INT, data VARCHAR(255))");
        $this->addSql("INSERT INTO user(id, data) VALUES(1, 'Barack - Obama - White House')");
        $this->addSql("INSERT INTO user(id, data) values(2, 'Britney - Spears - America')");
        $this->addSql("INSERT INTO user(id, data) values(3, 'Leonardo - DiCaprio - Titanic')");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
    }
}
