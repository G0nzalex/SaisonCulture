<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220427142334 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(200) NOT NULL, description LONGTEXT NOT NULL, createdat DATETIME NOT NULL, modifiedat DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE products (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(200) NOT NULL, bio TINYINT(1) NOT NULL, stock INT NOT NULL, price INT NOT NULL, description LONGTEXT NOT NULL, img VARCHAR(255) DEFAULT NULL, active TINYINT(1) NOT NULL, createdat DATETIME NOT NULL, modifiedat DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(200) NOT NULL, mail VARCHAR(200) NOT NULL, password VARCHAR(200) NOT NULL, token VARCHAR(200) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', company VARCHAR(200) DEFAULT NULL, address1 VARCHAR(200) DEFAULT NULL, address2 VARCHAR(200) DEFAULT NULL, city VARCHAR(200) DEFAULT NULL, zipcode INT DEFAULT NULL, phone INT DEFAULT NULL, createdat DATETIME NOT NULL, modifiedat DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE products');
        $this->addSql('DROP TABLE users');
    }
}
