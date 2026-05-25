<?php
declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260525000100 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create tasks and user_profiles tables and seed initial data';
    }

    public function up(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on mysql.');

        $this->addSql("CREATE TABLE tasks (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, status VARCHAR(32) NOT NULL, due_date DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', description LONGTEXT NOT NULL, priority VARCHAR(32) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB");
        $this->addSql('CREATE TABLE user_profiles (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, tag VARCHAR(64) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql("INSERT INTO tasks (id, name, status, due_date, description, priority) VALUES (1, 'Task 1', 'Done', '2025-01-01 00:00:00', 'Description of task 1', 'High')");
        $this->addSql("INSERT INTO tasks (id, name, status, due_date, description, priority) VALUES (2, 'Task 2', 'In progress', '2025-01-02 00:00:00', 'Description of task 2', 'Medium')");
        $this->addSql("INSERT INTO tasks (id, name, status, due_date, description, priority) VALUES (3, 'Task 3', 'Not started', '2025-01-03 00:00:00', 'Description of task 3', 'Low')");
        $this->addSql("INSERT INTO tasks (id, name, status, due_date, description, priority) VALUES (4, 'Task 4', 'Done', '2025-01-04 00:00:00', 'Description of task 4', 'High')");
        $this->addSql("INSERT INTO tasks (id, name, status, due_date, description, priority) VALUES (5, 'Task 5', 'In progress', '2025-01-05 00:00:00', 'Description of task 5', 'Medium')");

        $this->addSql("INSERT INTO user_profiles (id, name, tag) VALUES (101, 'Alex Carter', 'frontend')");
        $this->addSql("INSERT INTO user_profiles (id, name, tag) VALUES (102, 'Mia Thompson', 'design')");
        $this->addSql("INSERT INTO user_profiles (id, name, tag) VALUES (103, 'Daniel Lee', 'backend')");
    }

    public function down(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on mysql.');

        $this->addSql('DROP TABLE tasks');
        $this->addSql('DROP TABLE user_profiles');
    }
}
