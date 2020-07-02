<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200520152725 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE offre_reservation DROP FOREIGN KEY FK_9E1C375D56C31B7');
        $this->addSql('DROP TABLE logement_reserver');
        $this->addSql('ALTER TABLE offre_reservation DROP FOREIGN KEY FK_9E1C37575237061');
        $this->addSql('DROP INDEX IDX_9E1C37575237061 ON offre_reservation');
        $this->addSql('DROP INDEX IDX_9E1C375D56C31B7 ON offre_reservation');
        $this->addSql('ALTER TABLE offre_reservation DROP reservation_dun_user_id, DROP id_offre_reservation_fk_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE logement_reserver (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE offre_reservation ADD reservation_dun_user_id INT DEFAULT NULL, ADD id_offre_reservation_fk_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE offre_reservation ADD CONSTRAINT FK_9E1C37575237061 FOREIGN KEY (reservation_dun_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE offre_reservation ADD CONSTRAINT FK_9E1C375D56C31B7 FOREIGN KEY (id_offre_reservation_fk_id) REFERENCES logement_reserver (id)');
        $this->addSql('CREATE INDEX IDX_9E1C37575237061 ON offre_reservation (reservation_dun_user_id)');
        $this->addSql('CREATE INDEX IDX_9E1C375D56C31B7 ON offre_reservation (id_offre_reservation_fk_id)');
    }
}
