<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230326174823 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE donate_user (id SERIAL NOT NULL, goal_id INT DEFAULT NULL, username VARCHAR(100) NOT NULL, donate_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, donation_sum INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_750CCA26F85E0677 ON donate_user (username)');
        $this->addSql('CREATE INDEX IDX_750CCA26667D1AFE ON donate_user (goal_id)');
        $this->addSql('CREATE TABLE goal (id SERIAL NOT NULL, name VARCHAR(100) NOT NULL, description TEXT NOT NULL, final_sum INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FCDCEB2E5E237E06 ON goal (name)');
        $this->addSql('ALTER TABLE donate_user ADD CONSTRAINT FK_750CCA26667D1AFE FOREIGN KEY (goal_id) REFERENCES goal (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE donate_user DROP CONSTRAINT FK_750CCA26667D1AFE');
        $this->addSql('DROP TABLE donate_user');
        $this->addSql('DROP TABLE goal');
    }
}
