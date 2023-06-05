<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230605180849 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE course_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE discipline_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE education_program_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE profession_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE quantity_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tag_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE course (id INT NOT NULL, discipline_id INT NOT NULL, tag_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_169E6FB9A5522701 ON course (discipline_id)');
        $this->addSql('CREATE INDEX IDX_169E6FB9BAD26311 ON course (tag_id)');
        $this->addSql('CREATE TABLE discipline (id INT NOT NULL, education_program_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, semester INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75BEEE3F6344F027 ON discipline (education_program_id)');
        $this->addSql('CREATE TABLE education_program (id INT NOT NULL, name VARCHAR(255) NOT NULL, specialty INT DEFAULT NULL, university VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE profession (id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, vacancy_count INT DEFAULT NULL, average_salary INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE profession_tag (profession_id INT NOT NULL, tag_id INT NOT NULL, PRIMARY KEY(profession_id, tag_id))');
        $this->addSql('CREATE INDEX IDX_71CC06E8FDEF8996 ON profession_tag (profession_id)');
        $this->addSql('CREATE INDEX IDX_71CC06E8BAD26311 ON profession_tag (tag_id)');
        $this->addSql('CREATE TABLE quantity (id INT NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tag (id INT NOT NULL, name VARCHAR(255) NOT NULL, class VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tag_quantity (tag_id INT NOT NULL, quantity_id INT NOT NULL, PRIMARY KEY(tag_id, quantity_id))');
        $this->addSql('CREATE INDEX IDX_A9C26DEDBAD26311 ON tag_quantity (tag_id)');
        $this->addSql('CREATE INDEX IDX_A9C26DED7E8B4AFC ON tag_quantity (quantity_id)');
        $this->addSql('ALTER TABLE course ADD CONSTRAINT FK_169E6FB9A5522701 FOREIGN KEY (discipline_id) REFERENCES discipline (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE course ADD CONSTRAINT FK_169E6FB9BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE discipline ADD CONSTRAINT FK_75BEEE3F6344F027 FOREIGN KEY (education_program_id) REFERENCES education_program (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE profession_tag ADD CONSTRAINT FK_71CC06E8FDEF8996 FOREIGN KEY (profession_id) REFERENCES profession (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE profession_tag ADD CONSTRAINT FK_71CC06E8BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tag_quantity ADD CONSTRAINT FK_A9C26DEDBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tag_quantity ADD CONSTRAINT FK_A9C26DED7E8B4AFC FOREIGN KEY (quantity_id) REFERENCES quantity (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE course_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE discipline_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE education_program_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE profession_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE quantity_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tag_id_seq CASCADE');
        $this->addSql('ALTER TABLE course DROP CONSTRAINT FK_169E6FB9A5522701');
        $this->addSql('ALTER TABLE course DROP CONSTRAINT FK_169E6FB9BAD26311');
        $this->addSql('ALTER TABLE discipline DROP CONSTRAINT FK_75BEEE3F6344F027');
        $this->addSql('ALTER TABLE profession_tag DROP CONSTRAINT FK_71CC06E8FDEF8996');
        $this->addSql('ALTER TABLE profession_tag DROP CONSTRAINT FK_71CC06E8BAD26311');
        $this->addSql('ALTER TABLE tag_quantity DROP CONSTRAINT FK_A9C26DEDBAD26311');
        $this->addSql('ALTER TABLE tag_quantity DROP CONSTRAINT FK_A9C26DED7E8B4AFC');
        $this->addSql('DROP TABLE course');
        $this->addSql('DROP TABLE discipline');
        $this->addSql('DROP TABLE education_program');
        $this->addSql('DROP TABLE profession');
        $this->addSql('DROP TABLE profession_tag');
        $this->addSql('DROP TABLE quantity');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE tag_quantity');
    }
}
