<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210601194855 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE estado (id INT AUTO_INCREMENT NOT NULL, estado VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE servicio ADD estado_id INT DEFAULT NULL, DROP estado');
        $this->addSql('ALTER TABLE servicio ADD CONSTRAINT FK_CB86F22A9F5A440B FOREIGN KEY (estado_id) REFERENCES estado (id)');
        $this->addSql('CREATE INDEX IDX_CB86F22A9F5A440B ON servicio (estado_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE servicio DROP FOREIGN KEY FK_CB86F22A9F5A440B');
        $this->addSql('DROP TABLE estado');
        $this->addSql('DROP INDEX IDX_CB86F22A9F5A440B ON servicio');
        $this->addSql('ALTER TABLE servicio ADD estado TINYINT(1) DEFAULT NULL, DROP estado_id');
    }
}
