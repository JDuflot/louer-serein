<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230615132010 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rental_equipment_equipment (rental_equipment_id INT NOT NULL, equipment_id INT NOT NULL, INDEX IDX_C182BF96B568DAC3 (rental_equipment_id), INDEX IDX_C182BF96517FE9FE (equipment_id), PRIMARY KEY(rental_equipment_id, equipment_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rental_equipment_equipment ADD CONSTRAINT FK_C182BF96B568DAC3 FOREIGN KEY (rental_equipment_id) REFERENCES rental_equipment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rental_equipment_equipment ADD CONSTRAINT FK_C182BF96517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE picture ADD rental_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89A7CF2329 FOREIGN KEY (rental_id) REFERENCES rental (id)');
        $this->addSql('CREATE INDEX IDX_16DB4F89A7CF2329 ON picture (rental_id)');
        $this->addSql('ALTER TABLE rental_equipment ADD rental_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rental_equipment ADD CONSTRAINT FK_6CD8D28CA7CF2329 FOREIGN KEY (rental_id) REFERENCES rental (id)');
        $this->addSql('CREATE INDEX IDX_6CD8D28CA7CF2329 ON rental_equipment (rental_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rental_equipment_equipment DROP FOREIGN KEY FK_C182BF96B568DAC3');
        $this->addSql('ALTER TABLE rental_equipment_equipment DROP FOREIGN KEY FK_C182BF96517FE9FE');
        $this->addSql('DROP TABLE rental_equipment_equipment');
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F89A7CF2329');
        $this->addSql('DROP INDEX IDX_16DB4F89A7CF2329 ON picture');
        $this->addSql('ALTER TABLE picture DROP rental_id');
        $this->addSql('ALTER TABLE rental_equipment DROP FOREIGN KEY FK_6CD8D28CA7CF2329');
        $this->addSql('DROP INDEX IDX_6CD8D28CA7CF2329 ON rental_equipment');
        $this->addSql('ALTER TABLE rental_equipment DROP rental_id');
    }
}
