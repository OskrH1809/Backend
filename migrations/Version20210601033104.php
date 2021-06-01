<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210601033104 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE perfil (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, acceso VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD perfil_id INT DEFAULT NULL, ADD nombre VARCHAR(180) NOT NULL, DROP roles');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64957291544 FOREIGN KEY (perfil_id) REFERENCES perfil (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6493A909126 ON user (nombre)');
        $this->addSql('CREATE INDEX IDX_8D93D64957291544 ON user (perfil_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D64957291544');
        $this->addSql('DROP TABLE perfil');
        $this->addSql('DROP INDEX UNIQ_8D93D6493A909126 ON `user`');
        $this->addSql('DROP INDEX IDX_8D93D64957291544 ON `user`');
        $this->addSql('ALTER TABLE `user` ADD roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:json)\', DROP perfil_id, DROP nombre');
    }
}
