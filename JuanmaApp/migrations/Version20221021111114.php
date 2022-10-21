<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221021111114 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_juanma ADD dinero_id INT NOT NULL');
        $this->addSql('ALTER TABLE app_juanma ADD CONSTRAINT FK_E7A9BDC8D2C59E1F FOREIGN KEY (dinero_id) REFERENCES dinero (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E7A9BDC8D2C59E1F ON app_juanma (dinero_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_juanma DROP FOREIGN KEY FK_E7A9BDC8D2C59E1F');
        $this->addSql('DROP INDEX UNIQ_E7A9BDC8D2C59E1F ON app_juanma');
        $this->addSql('ALTER TABLE app_juanma DROP dinero_id');
    }
}
