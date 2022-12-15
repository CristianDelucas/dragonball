<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211201115416 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE planetas (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE planetas_personaje (planetas_id INT NOT NULL, personaje_id INT NOT NULL, INDEX IDX_2B5C1FFADDE241B7 (planetas_id), INDEX IDX_2B5C1FFA121EFAFB (personaje_id), PRIMARY KEY(planetas_id, personaje_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE planetas_personaje ADD CONSTRAINT FK_2B5C1FFADDE241B7 FOREIGN KEY (planetas_id) REFERENCES planetas (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE planetas_personaje ADD CONSTRAINT FK_2B5C1FFA121EFAFB FOREIGN KEY (personaje_id) REFERENCES personaje (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE planetas_personaje DROP FOREIGN KEY FK_2B5C1FFADDE241B7');
        $this->addSql('DROP TABLE planetas');
        $this->addSql('DROP TABLE planetas_personaje');
    }
}
