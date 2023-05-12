<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230503124639 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_fields (id SERIAL NOT NULL, account_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, patronymic VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1BB7F8B59B6B5FBA ON user_fields (account_id)');
        $this->addSql('ALTER TABLE user_fields ADD CONSTRAINT FK_1BB7F8B59B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE account ADD user_fields_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE account ADD CONSTRAINT FK_7D3656A42CB4B44A FOREIGN KEY (user_fields_id) REFERENCES user_fields (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7D3656A42CB4B44A ON account (user_fields_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE account DROP CONSTRAINT FK_7D3656A42CB4B44A');
        $this->addSql('ALTER TABLE user_fields DROP CONSTRAINT FK_1BB7F8B59B6B5FBA');
        $this->addSql('DROP TABLE user_fields');
        $this->addSql('DROP INDEX UNIQ_7D3656A42CB4B44A');
        $this->addSql('ALTER TABLE account DROP user_fields_id');
    }
}
