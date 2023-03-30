<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230225151726 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("
            INSERT INTO account (id, username, roles, password) VALUES (NULL, 'Admin', '[\"ROLE_USER\", \"ROLE_ADMIN\"]', '$2y$13\$yBsjgFnrzJNUKv9H3Lfhf.ypC48jjIRWpwdjVOYYl5qpZOKEo8B5C')
        ");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DELETE FROM account WHERE id = 2');
    }
}
