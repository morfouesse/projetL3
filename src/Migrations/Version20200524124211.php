<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200524124211 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE equipement_dun_logement (id INT AUTO_INCREMENT NOT NULL, le_logement_id INT DEFAULT NULL, lequipement_id INT DEFAULT NULL, INDEX IDX_180BA23B198C834A (le_logement_id), INDEX IDX_180BA23BF8882E1D (lequipement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE equipement_dun_logement ADD CONSTRAINT FK_180BA23B198C834A FOREIGN KEY (le_logement_id) REFERENCES logement (id)');
        $this->addSql('ALTER TABLE equipement_dun_logement ADD CONSTRAINT FK_180BA23BF8882E1D FOREIGN KEY (lequipement_id) REFERENCES equipement (id)');
        $this->addSql('DROP TABLE logement_equipement');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE logement_equipement (logement_id INT NOT NULL, equipement_id INT NOT NULL, INDEX IDX_85F96971806F0F5C (equipement_id), INDEX IDX_85F9697158ABF955 (logement_id), PRIMARY KEY(logement_id, equipement_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE logement_equipement ADD CONSTRAINT FK_85F9697158ABF955 FOREIGN KEY (logement_id) REFERENCES logement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE logement_equipement ADD CONSTRAINT FK_85F96971806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE equipement_dun_logement');
    }
}
