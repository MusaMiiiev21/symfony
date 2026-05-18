<?php
declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260518000200 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create feedback_requests table';
    }

    public function up(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on mysql.');

        $this->addSql("CREATE TABLE feedback_requests (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, phone VARCHAR(32) NOT NULL, email VARCHAR(255) NOT NULL, gender VARCHAR(16) NOT NULL, department VARCHAR(32) NOT NULL, message LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_FEEDBACK_REQUESTS_CREATED_AT (created_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB");
    }

    public function down(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on mysql.');

        $this->addSql('DROP TABLE feedback_requests');
    }
}