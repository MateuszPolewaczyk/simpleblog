<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180126140207 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE post CHANGE intro_text intro_text LONGTEXT DEFAULT NULL, CHANGE body_text_first body_text_first LONGTEXT NOT NULL, CHANGE body_text_second body_text_second LONGTEXT DEFAULT NULL, CHANGE body_text_third body_text_third LONGTEXT DEFAULT NULL, CHANGE outro_text outro_text LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE post CHANGE intro_text intro_text VARCHAR(500) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE body_text_first body_text_first VARCHAR(1000) NOT NULL COLLATE utf8_unicode_ci, CHANGE body_text_second body_text_second VARCHAR(1000) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE body_text_third body_text_third VARCHAR(1000) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE outro_text outro_text VARCHAR(500) DEFAULT NULL COLLATE utf8_unicode_ci');
    }
}
