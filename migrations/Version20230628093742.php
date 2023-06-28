<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230628093742 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chat DROP FOREIGN KEY FK_659DF2AAA76ED395');
        $this->addSql('DROP INDEX IDX_659DF2AAA76ED395 ON chat');
        $this->addSql('ALTER TABLE chat ADD recipient_id INT NOT NULL, DROP sender, DROP recipient, CHANGE user_id sender_id INT NOT NULL');
        $this->addSql('ALTER TABLE chat ADD CONSTRAINT FK_659DF2AAF624B39D FOREIGN KEY (sender_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE chat ADD CONSTRAINT FK_659DF2AAE92F8F78 FOREIGN KEY (recipient_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_659DF2AAF624B39D ON chat (sender_id)');
        $this->addSql('CREATE INDEX IDX_659DF2AAE92F8F78 ON chat (recipient_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chat DROP FOREIGN KEY FK_659DF2AAF624B39D');
        $this->addSql('ALTER TABLE chat DROP FOREIGN KEY FK_659DF2AAE92F8F78');
        $this->addSql('DROP INDEX IDX_659DF2AAF624B39D ON chat');
        $this->addSql('DROP INDEX IDX_659DF2AAE92F8F78 ON chat');
        $this->addSql('ALTER TABLE chat ADD user_id INT NOT NULL, ADD sender VARCHAR(255) NOT NULL, ADD recipient VARCHAR(255) NOT NULL, DROP sender_id, DROP recipient_id');
        $this->addSql('ALTER TABLE chat ADD CONSTRAINT FK_659DF2AAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_659DF2AAA76ED395 ON chat (user_id)');
    }
}
