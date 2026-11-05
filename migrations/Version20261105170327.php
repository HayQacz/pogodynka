<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261105170327 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE measurement ADD COLUMN precipitation NUMERIC(5, 2) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__measurement AS SELECT id, measured_at, temperature_c, humidity, pressure, wind_speed, location_id FROM measurement');
        $this->addSql('DROP TABLE measurement');
        $this->addSql('CREATE TABLE measurement (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, measured_at DATETIME NOT NULL, temperature_c NUMERIC(5, 2) NOT NULL, humidity INTEGER NOT NULL, pressure INTEGER NOT NULL, wind_speed NUMERIC(5, 2) NOT NULL, location_id INTEGER NOT NULL, CONSTRAINT FK_2CE0D81164D218E FOREIGN KEY (location_id) REFERENCES location (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO measurement (id, measured_at, temperature_c, humidity, pressure, wind_speed, location_id) SELECT id, measured_at, temperature_c, humidity, pressure, wind_speed, location_id FROM __temp__measurement');
        $this->addSql('DROP TABLE __temp__measurement');
        $this->addSql('CREATE INDEX IDX_2CE0D81164D218E ON measurement (location_id)');
    }
}
