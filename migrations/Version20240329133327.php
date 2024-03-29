<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240329133327 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animal (id INT AUTO_INCREMENT NOT NULL, owner_id_id INT NOT NULL, type_id_id INT NOT NULL, name VARCHAR(255) NOT NULL, image_path VARCHAR(255) DEFAULT NULL, date_birth DATE DEFAULT NULL, sex VARCHAR(255) NOT NULL, is_sterilized TINYINT(1) DEFAULT NULL, allergy VARCHAR(255) DEFAULT NULL, additional_info LONGTEXT DEFAULT NULL, INDEX IDX_6AAB231F8FDDAB70 (owner_id_id), INDEX IDX_6AAB231F714819A0 (type_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE animal_vaccination (animal_id INT NOT NULL, vaccination_id INT NOT NULL, INDEX IDX_BCB34A208E962C16 (animal_id), INDEX IDX_BCB34A204DDCCFA3 (vaccination_id), PRIMARY KEY(animal_id, vaccination_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE animal_type (id INT AUTO_INCREMENT NOT NULL, type_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, city_name VARCHAR(255) NOT NULL, postcode VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE consultation (id INT AUTO_INCREMENT NOT NULL, animal_id_id INT NOT NULL, doctor_id_id INT NOT NULL, reason VARCHAR(255) NOT NULL, resume LONGTEXT NOT NULL, prescription LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', INDEX IDX_964685A65EB747A3 (animal_id_id), INDEX IDX_964685A632B07E31 (doctor_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE doctor (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, city_id_id INT NOT NULL, image_path VARCHAR(255) DEFAULT NULL, address VARCHAR(255) NOT NULL, clinic_name VARCHAR(255) DEFAULT NULL, education LONGTEXT DEFAULT NULL, is_emergency TINYINT(1) NOT NULL, experience LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_1FC0F36A9D86650F (user_id_id), INDEX IDX_1FC0F36A3CCE3900 (city_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE doctor_animal_type (doctor_id INT NOT NULL, animal_type_id INT NOT NULL, INDEX IDX_4CCCA2E687F4FB17 (doctor_id), INDEX IDX_4CCCA2E64A93E3A9 (animal_type_id), PRIMARY KEY(doctor_id, animal_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE doctor_service (doctor_id INT NOT NULL, service_id INT NOT NULL, INDEX IDX_7230F97F87F4FB17 (doctor_id), INDEX IDX_7230F97FED5CA9E6 (service_id), PRIMARY KEY(doctor_id, service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pet_owner (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, city_id_id INT DEFAULT NULL, image_path VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_621C26DF9D86650F (user_id_id), INDEX IDX_621C26DF3CCE3900 (city_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, service_name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vaccination (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vaccination_animal_type (vaccination_id INT NOT NULL, animal_type_id INT NOT NULL, INDEX IDX_14E224D94DDCCFA3 (vaccination_id), INDEX IDX_14E224D94A93E3A9 (animal_type_id), PRIMARY KEY(vaccination_id, animal_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F8FDDAB70 FOREIGN KEY (owner_id_id) REFERENCES pet_owner (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F714819A0 FOREIGN KEY (type_id_id) REFERENCES animal_type (id)');
        $this->addSql('ALTER TABLE animal_vaccination ADD CONSTRAINT FK_BCB34A208E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE animal_vaccination ADD CONSTRAINT FK_BCB34A204DDCCFA3 FOREIGN KEY (vaccination_id) REFERENCES vaccination (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A65EB747A3 FOREIGN KEY (animal_id_id) REFERENCES animal (id)');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A632B07E31 FOREIGN KEY (doctor_id_id) REFERENCES doctor (id)');
        $this->addSql('ALTER TABLE doctor ADD CONSTRAINT FK_1FC0F36A9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE doctor ADD CONSTRAINT FK_1FC0F36A3CCE3900 FOREIGN KEY (city_id_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE doctor_animal_type ADD CONSTRAINT FK_4CCCA2E687F4FB17 FOREIGN KEY (doctor_id) REFERENCES doctor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE doctor_animal_type ADD CONSTRAINT FK_4CCCA2E64A93E3A9 FOREIGN KEY (animal_type_id) REFERENCES animal_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE doctor_service ADD CONSTRAINT FK_7230F97F87F4FB17 FOREIGN KEY (doctor_id) REFERENCES doctor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE doctor_service ADD CONSTRAINT FK_7230F97FED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pet_owner ADD CONSTRAINT FK_621C26DF9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE pet_owner ADD CONSTRAINT FK_621C26DF3CCE3900 FOREIGN KEY (city_id_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE vaccination_animal_type ADD CONSTRAINT FK_14E224D94DDCCFA3 FOREIGN KEY (vaccination_id) REFERENCES vaccination (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vaccination_animal_type ADD CONSTRAINT FK_14E224D94A93E3A9 FOREIGN KEY (animal_type_id) REFERENCES animal_type (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F8FDDAB70');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F714819A0');
        $this->addSql('ALTER TABLE animal_vaccination DROP FOREIGN KEY FK_BCB34A208E962C16');
        $this->addSql('ALTER TABLE animal_vaccination DROP FOREIGN KEY FK_BCB34A204DDCCFA3');
        $this->addSql('ALTER TABLE consultation DROP FOREIGN KEY FK_964685A65EB747A3');
        $this->addSql('ALTER TABLE consultation DROP FOREIGN KEY FK_964685A632B07E31');
        $this->addSql('ALTER TABLE doctor DROP FOREIGN KEY FK_1FC0F36A9D86650F');
        $this->addSql('ALTER TABLE doctor DROP FOREIGN KEY FK_1FC0F36A3CCE3900');
        $this->addSql('ALTER TABLE doctor_animal_type DROP FOREIGN KEY FK_4CCCA2E687F4FB17');
        $this->addSql('ALTER TABLE doctor_animal_type DROP FOREIGN KEY FK_4CCCA2E64A93E3A9');
        $this->addSql('ALTER TABLE doctor_service DROP FOREIGN KEY FK_7230F97F87F4FB17');
        $this->addSql('ALTER TABLE doctor_service DROP FOREIGN KEY FK_7230F97FED5CA9E6');
        $this->addSql('ALTER TABLE pet_owner DROP FOREIGN KEY FK_621C26DF9D86650F');
        $this->addSql('ALTER TABLE pet_owner DROP FOREIGN KEY FK_621C26DF3CCE3900');
        $this->addSql('ALTER TABLE vaccination_animal_type DROP FOREIGN KEY FK_14E224D94DDCCFA3');
        $this->addSql('ALTER TABLE vaccination_animal_type DROP FOREIGN KEY FK_14E224D94A93E3A9');
        $this->addSql('DROP TABLE animal');
        $this->addSql('DROP TABLE animal_vaccination');
        $this->addSql('DROP TABLE animal_type');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE consultation');
        $this->addSql('DROP TABLE doctor');
        $this->addSql('DROP TABLE doctor_animal_type');
        $this->addSql('DROP TABLE doctor_service');
        $this->addSql('DROP TABLE pet_owner');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE vaccination');
        $this->addSql('DROP TABLE vaccination_animal_type');
    }
}
