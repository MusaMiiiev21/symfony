<?php
declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260518000100 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add slug to categories and sku/price/is_active to products';
    }

    public function up(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on mysql.');

        $this->addSql('ALTER TABLE categories ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3AF34668789AC48 ON categories (slug)');
        $this->addSql("UPDATE categories SET slug = LOWER(REPLACE(name, ' ', '-')) WHERE slug = '' OR slug IS NULL");

        $this->addSql('ALTER TABLE products ADD sku VARCHAR(64) NOT NULL, ADD price NUMERIC(10, 2) NOT NULL, ADD is_active TINYINT(1) NOT NULL DEFAULT 1');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B3BA5A5A8E48560F ON products (sku)');
        $this->addSql('UPDATE products SET sku = CONCAT(\'SKU-\', id), price = 99.90, is_active = 1');
    }

    public function down(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on mysql.');

        $this->addSql('DROP INDEX UNIQ_B3BA5A5A8E48560F ON products');
        $this->addSql('ALTER TABLE products DROP sku, DROP price, DROP is_active');

        $this->addSql('DROP INDEX UNIQ_3AF34668789AC48 ON categories');
        $this->addSql('ALTER TABLE categories DROP slug');
    }
}
