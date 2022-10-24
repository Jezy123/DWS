<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221024114256 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE usuario ADD moneda_id INT NOT NULL');
        $this->addSql('ALTER TABLE usuario ADD CONSTRAINT FK_2265B05DB77634D2 FOREIGN KEY (moneda_id) REFERENCES moneda (id)');
        $this->addSql('CREATE INDEX IDX_2265B05DB77634D2 ON usuario (moneda_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE usuario DROP FOREIGN KEY FK_2265B05DB77634D2');
        $this->addSql('DROP INDEX IDX_2265B05DB77634D2 ON usuario');
        $this->addSql('ALTER TABLE usuario DROP moneda_id');
    }
}
