<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210601033658 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_servicio (user_id INT NOT NULL, servicio_id INT NOT NULL, INDEX IDX_2B0B162AA76ED395 (user_id), INDEX IDX_2B0B162A71CAA3E7 (servicio_id), PRIMARY KEY(user_id, servicio_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_servicio ADD CONSTRAINT FK_2B0B162AA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_servicio ADD CONSTRAINT FK_2B0B162A71CAA3E7 FOREIGN KEY (servicio_id) REFERENCES servicio (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user_servicio');
    }
}
