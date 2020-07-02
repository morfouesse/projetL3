<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200520153313 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE offre_reservation ADD reservation_dun_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE offre_reservation ADD CONSTRAINT FK_9E1C37575237061 FOREIGN KEY (reservation_dun_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_9E1C37575237061 ON offre_reservation (reservation_dun_user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE offre_reservation DROP FOREIGN KEY FK_9E1C37575237061');
        $this->addSql('DROP INDEX IDX_9E1C37575237061 ON offre_reservation');
        $this->addSql('ALTER TABLE offre_reservation DROP reservation_dun_user_id');
    }
}
