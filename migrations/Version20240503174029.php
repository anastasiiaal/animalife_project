<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240503174029 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE consultation_vaccination (consultation_id INT NOT NULL, vaccination_id INT NOT NULL, INDEX IDX_FEE2EF1162FF6CDF (consultation_id), INDEX IDX_FEE2EF114DDCCFA3 (vaccination_id), PRIMARY KEY(consultation_id, vaccination_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE consultation_vaccination ADD CONSTRAINT FK_FEE2EF1162FF6CDF FOREIGN KEY (consultation_id) REFERENCES consultation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE consultation_vaccination ADD CONSTRAINT FK_FEE2EF114DDCCFA3 FOREIGN KEY (vaccination_id) REFERENCES vaccination (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE consultation ADD date DATETIME NOT NULL, ADD animal_weight NUMERIC(6, 2) DEFAULT NULL, ADD next_visit DATE DEFAULT NULL, ADD document VARCHAR(255) DEFAULT NULL, ADD control_eyes TINYINT(1) DEFAULT NULL, ADD control_ears TINYINT(1) DEFAULT NULL, ADD control_skin TINYINT(1) DEFAULT NULL, ADD control_digestion TINYINT(1) DEFAULT NULL, ADD control_heart TINYINT(1) DEFAULT NULL, ADD control_lungs TINYINT(1) DEFAULT NULL, ADD control_movement TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consultation_vaccination DROP FOREIGN KEY FK_FEE2EF1162FF6CDF');
        $this->addSql('ALTER TABLE consultation_vaccination DROP FOREIGN KEY FK_FEE2EF114DDCCFA3');
        $this->addSql('DROP TABLE consultation_vaccination');
        $this->addSql('ALTER TABLE consultation DROP date, DROP animal_weight, DROP next_visit, DROP document, DROP control_eyes, DROP control_ears, DROP control_skin, DROP control_digestion, DROP control_heart, DROP control_lungs, DROP control_movement');
    }
}
