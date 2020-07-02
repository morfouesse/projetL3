<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200520160659 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE logement ADD un_equipement_dun_logement_id INT NOT NULL');
        $this->addSql('ALTER TABLE logement ADD CONSTRAINT FK_F0FD44574C8735C8 FOREIGN KEY (un_equipement_dun_logement_id) REFERENCES equipement_dun_logement (id)');
        $this->addSql('CREATE INDEX IDX_F0FD44574C8735C8 ON logement (un_equipement_dun_logement_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE logement DROP FOREIGN KEY FK_F0FD44574C8735C8');
        $this->addSql('DROP INDEX IDX_F0FD44574C8735C8 ON logement');
        $this->addSql('ALTER TABLE logement DROP un_equipement_dun_logement_id');
    }
}
