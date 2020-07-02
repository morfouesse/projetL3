<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200520142031 extends AbstractMigration
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
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D56C31B7');
        $this->addSql('DROP INDEX IDX_8D93D649D56C31B7 ON user');
        $this->addSql('ALTER TABLE user DROP id_offre_reservation_fk_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE offre_reservation DROP FOREIGN KEY FK_9E1C37575237061');
        $this->addSql('DROP INDEX IDX_9E1C37575237061 ON offre_reservation');
        $this->addSql('ALTER TABLE offre_reservation DROP reservation_dun_user_id');
        $this->addSql('ALTER TABLE user ADD id_offre_reservation_fk_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D56C31B7 FOREIGN KEY (id_offre_reservation_fk_id) REFERENCES offre_reservation (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649D56C31B7 ON user (id_offre_reservation_fk_id)');
    }
}
