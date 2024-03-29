<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200719180945 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ville (id INT AUTO_INCREMENT NOT NULL, dest_ville_id INT NOT NULL, code_ville INT NOT NULL, des_ville VARCHAR(255) NOT NULL, INDEX IDX_43C3D9C3865BADBA (dest_ville_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE circuit (id INT AUTO_INCREMENT NOT NULL, code_circuit INT NOT NULL, des_circuit VARCHAR(255) NOT NULL, durée_circuit INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE destination (id INT AUTO_INCREMENT NOT NULL, code_dest INT NOT NULL, des_dest VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etape_circuit (id INT AUTO_INCREMENT NOT NULL, ville_etape_id INT NOT NULL, circuit_étape_id INT NOT NULL, durée_étape INT NOT NULL, ordre_étape INT NOT NULL, INDEX IDX_484C507D886D48A3 (ville_etape_id), INDEX IDX_484C507DC4E5CA2A (circuit_étape_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ville ADD CONSTRAINT FK_43C3D9C3865BADBA FOREIGN KEY (dest_ville_id) REFERENCES destination (id)');
        $this->addSql('ALTER TABLE etape_circuit ADD CONSTRAINT FK_484C507D886D48A3 FOREIGN KEY (ville_etape_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE etape_circuit ADD CONSTRAINT FK_484C507DC4E5CA2A FOREIGN KEY (circuit_étape_id) REFERENCES circuit (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE etape_circuit DROP FOREIGN KEY FK_484C507D886D48A3');
        $this->addSql('ALTER TABLE etape_circuit DROP FOREIGN KEY FK_484C507DC4E5CA2A');
        $this->addSql('ALTER TABLE ville DROP FOREIGN KEY FK_43C3D9C3865BADBA');
        $this->addSql('DROP TABLE ville');
        $this->addSql('DROP TABLE circuit');
        $this->addSql('DROP TABLE destination');
        $this->addSql('DROP TABLE etape_circuit');
    }
}
