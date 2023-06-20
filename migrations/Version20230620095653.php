<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230620095653 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE specie_type (specie_id INT NOT NULL, type_id INT NOT NULL, INDEX IDX_E35024C5D5436AB7 (specie_id), INDEX IDX_E35024C5C54C8C93 (type_id), PRIMARY KEY(specie_id, type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE specie_type ADD CONSTRAINT FK_E35024C5D5436AB7 FOREIGN KEY (specie_id) REFERENCES specie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE specie_type ADD CONSTRAINT FK_E35024C5C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pokemon_type DROP FOREIGN KEY FK_B077296A2FE71C3E');
        $this->addSql('ALTER TABLE pokemon_type DROP FOREIGN KEY FK_B077296AC54C8C93');
        $this->addSql('DROP TABLE pokemon_type');
        $this->addSql('ALTER TABLE pokemon ADD CONSTRAINT FK_62DC90F3D5436AB7 FOREIGN KEY (specie_id) REFERENCES specie (id)');
        $this->addSql('CREATE INDEX IDX_62DC90F3D5436AB7 ON pokemon (specie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pokemon_type (pokemon_id INT NOT NULL, type_id INT NOT NULL, INDEX IDX_B077296A2FE71C3E (pokemon_id), INDEX IDX_B077296AC54C8C93 (type_id), PRIMARY KEY(pokemon_id, type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE pokemon_type ADD CONSTRAINT FK_B077296A2FE71C3E FOREIGN KEY (pokemon_id) REFERENCES pokemon (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pokemon_type ADD CONSTRAINT FK_B077296AC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE specie_type DROP FOREIGN KEY FK_E35024C5D5436AB7');
        $this->addSql('ALTER TABLE specie_type DROP FOREIGN KEY FK_E35024C5C54C8C93');
        $this->addSql('DROP TABLE specie_type');
        $this->addSql('ALTER TABLE pokemon DROP FOREIGN KEY FK_62DC90F3D5436AB7');
        $this->addSql('DROP INDEX IDX_62DC90F3D5436AB7 ON pokemon');
    }
}
