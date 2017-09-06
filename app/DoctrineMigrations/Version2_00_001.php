<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\SchemaException;


class Version2_00_001 extends AbstractMigration {
    /**
     * @param Schema $schema
     *
     * 18 sql queries
     */
    public function up(Schema $schema) {
        try {
            $table = $schema->getTable('yearcotisation');
        } catch (SchemaException $e) {
            $this->addSql('CREATE TABLE YearCotisation (id INT AUTO_INCREMENT NOT NULL, year INT NOT NULL, dateEnabled DATETIME NOT NULL, reducedFeeAmount INT NOT NULL, minAmount INT NOT NULL, proposedAmount1 INT NOT NULL, proposedAmount2 INT NOT NULL, proposedAmount3 INT NOT NULL, proposedAmount4 INT NOT NULL, UNIQUE INDEX UNIQ_5C305649BB827337 (year), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;');
            $this->addSql('INSERT INTO YearCotisation (year,dateEnabled,minAmount,reducedFeeAmount,proposedAmount1, proposedAmount2, proposedAmount3, proposedAmount4)
  VALUES(2015,"2015-01-01",10,5,20,30,40,50);');
            $this->addSql('INSERT INTO YearCotisation (year,dateEnabled,minAmount,reducedFeeAmount,proposedAmount1, proposedAmount2, proposedAmount3, proposedAmount4)
  VALUES(2016,"2016-01-01",10,5,20,30,40,50);');
            $this->addSql('INSERT INTO YearCotisation (year,dateEnabled,minAmount,reducedFeeAmount,proposedAmount1, proposedAmount2, proposedAmount3, proposedAmount4)
  VALUES(2017,"2017-01-01",10,5,20,30,40,50);');
            $this->addSql('INSERT INTO YearCotisation (year,dateEnabled,minAmount,reducedFeeAmount,proposedAmount1, proposedAmount2, proposedAmount3, proposedAmount4)
  VALUES(2018,"2018-01-01",10,5,20,30,40,50);');

        }


        try {
            $table = $schema->getTable('cotisation');
            $column = $table->getColumn('yearCotisation_id');

        } catch (SchemaException $e) {
            $this->addSql('ALTER TABLE cotisation ADD yearCotisation_id INT DEFAULT NULL;');
            $this->addSql('UPDATE Cotisation SET yearCotisation_id=YEAR(year)-2014;');
        }

        try {
            $table = $schema->getTable('cotisation');
            $fk = $table->getForeignKey('FK_E139D13D50CC17E8');
            $this->addSql('ALTER TABLE cotisation DROP FOREIGN KEY FK_E139D13D50CC17E8;');
        } catch (SchemaException $e) {
        }

        try {
            $table = $schema->getTable('cotisation');
            $column = $table->getColumn('paymentType');

        } catch (SchemaException $e) {
            $this->addSql('ALTER TABLE cotisation ADD paymentType INT DEFAULT NULL;');
            $this->addSql('UPDATE cotisation set paymentType = -1;');
        }

        try {
            $table = $schema->getTable('cotisation');
            $column = $table->getColumn('year');
            $this->addSql('ALTER TABLE cotisation DROP year ;');
        } catch (SchemaException $e) {
        }

        try {
            $table = $schema->getTable('cotisation');
            $column = $table->getColumn('namecotisation');
            $this->addSql('ALTER TABLE cotisation DROP namecotisation;');
        } catch (SchemaException $e) {
        }

        try {
            $table = $schema->getTable('cotisation');
            $column = $table->getColumn('typeCotisation_id');
            $this->addSql('ALTER TABLE cotisation DROP typeCotisation_id;');
        } catch (SchemaException $e) {
        }

        try {
            $table = $schema->getTable('cotisation');
            $fk = $table->getForeignKey('FK_E139D13DFD918BA7');
        } catch (SchemaException $e)
        {
            $this->addSql('ALTER TABLE cotisation ADD CONSTRAINT FK_E139D13DFD918BA7 FOREIGN KEY (yearCotisation_id) REFERENCES YearCotisation (id);');
        }

        try {
            $table = $schema->getTable('cotisation');
            $index = $table->getIndex('IDX_E139D13DFD918BA7');
        } catch (SchemaException $e)
        {
            $this->addSql('CREATE INDEX IDX_E139D13DFD918BA7 ON cotisation (yearCotisation_id);');

        }

        try {
            $table = $schema->getTable('typecotisation');
            $this->addSql('DROP TABLE typecotisation;');
        } catch (SchemaException $e)
        {}

        try {
            $table = $schema->getTable('invoice');
            $this->addSql('DROP TABLE invoice;');
        } catch (SchemaException $e)
        {}

        $this->addSql('COMMIT;');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema) {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
