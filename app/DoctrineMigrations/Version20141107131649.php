<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141107131649 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('CREATE TABLE CategoryIncome (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE CategoryExpense (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Expense (id INT AUTO_INCREMENT NOT NULL, created_by INT DEFAULT NULL, amount NUMERIC(10, 0) NOT NULL, description VARCHAR(255) NOT NULL, dateExpense DATE NOT NULL, createAt DATETIME NOT NULL, categoryExpense_id INT DEFAULT NULL, INDEX IDX_E287B43ADE12AB56 (created_by), INDEX IDX_E287B43A3634AB86 (categoryExpense_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE income (id INT AUTO_INCREMENT NOT NULL, created_by INT DEFAULT NULL, amount NUMERIC(10, 0) NOT NULL, description VARCHAR(255) NOT NULL, date_income DATE NOT NULL, createAt DATETIME NOT NULL, categoryIncome_id INT DEFAULT NULL, INDEX IDX_3FA862D0DE12AB56 (created_by), INDEX IDX_3FA862D07F459178 (categoryIncome_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Expense ADD CONSTRAINT FK_E287B43ADE12AB56 FOREIGN KEY (created_by) REFERENCES user (id)');
        $this->addSql('ALTER TABLE Expense ADD CONSTRAINT FK_E287B43A3634AB86 FOREIGN KEY (categoryExpense_id) REFERENCES CategoryExpense (id)');
        $this->addSql('ALTER TABLE income ADD CONSTRAINT FK_3FA862D0DE12AB56 FOREIGN KEY (created_by) REFERENCES user (id)');
        $this->addSql('ALTER TABLE income ADD CONSTRAINT FK_3FA862D07F459178 FOREIGN KEY (categoryIncome_id) REFERENCES CategoryIncome (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('ALTER TABLE income DROP FOREIGN KEY FK_3FA862D07F459178');
        $this->addSql('ALTER TABLE Expense DROP FOREIGN KEY FK_E287B43A3634AB86');
        $this->addSql('DROP TABLE CategoryIncome');
        $this->addSql('DROP TABLE CategoryExpense');
        $this->addSql('DROP TABLE Expense');
        $this->addSql('DROP TABLE income');
    }
}
