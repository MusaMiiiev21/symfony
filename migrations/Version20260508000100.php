<?php
declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260508000100 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create categories and products tables with many-to-one relation';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE categories (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description CLOB DEFAULT NULL)');
        $this->addSql('CREATE TABLE products (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, category_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, description CLOB DEFAULT NULL, CONSTRAINT FK_B3BA5A5A12469DE2 FOREIGN KEY (category_id) REFERENCES categories (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_B3BA5A5A12469DE2 ON products (category_id)');

        $this->addSql("INSERT INTO categories (id, name, description) VALUES (1, 'Electronics', 'Gadgets and devices')");
        $this->addSql("INSERT INTO categories (id, name, description) VALUES (2, 'Books', 'Printed and digital books')");
        $this->addSql("INSERT INTO categories (id, name, description) VALUES (3, 'Home', 'Home and kitchen items')");

        $this->addSql("INSERT INTO products (id, category_id, name, description) VALUES (1, 1, 'Product 1', 'Description for product 1')");
        $this->addSql("INSERT INTO products (id, category_id, name, description) VALUES (2, 1, 'Product 2', 'Description for product 2')");
        $this->addSql("INSERT INTO products (id, category_id, name, description) VALUES (3, 2, 'Product 3', 'Description for product 3')");
        $this->addSql("INSERT INTO products (id, category_id, name, description) VALUES (4, 3, 'Product 4', 'Description for product 4')");
        $this->addSql("INSERT INTO products (id, category_id, name, description) VALUES (5, 2, 'Product 5', 'Description for product 5')");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE products');
        $this->addSql('DROP TABLE categories');
    }
}
