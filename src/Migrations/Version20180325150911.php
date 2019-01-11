<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180325150911 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE chat_room (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chat_rooms_users (chat_room_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_E89A2BC41819BCFA (chat_room_id), INDEX IDX_E89A2BC4A76ED395 (user_id), PRIMARY KEY(chat_room_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, user_id VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, dtype VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, sender_id INT DEFAULT NULL, content_text LONGTEXT NOT NULL, type LONGTEXT NOT NULL, is_sent TINYINT(1) NOT NULL, send_at DATETIME NOT NULL, dtype VARCHAR(255) NOT NULL, INDEX IDX_B6BD307FF624B39D (sender_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message_chat_room (message_id INT NOT NULL, chat_room_id INT NOT NULL, INDEX IDX_BEBACAEC537A1329 (message_id), INDEX IDX_BEBACAEC1819BCFA (chat_room_id), PRIMARY KEY(message_id, chat_room_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE chat_rooms_users ADD CONSTRAINT FK_E89A2BC41819BCFA FOREIGN KEY (chat_room_id) REFERENCES chat_room (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE chat_rooms_users ADD CONSTRAINT FK_E89A2BC4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FF624B39D FOREIGN KEY (sender_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message_chat_room ADD CONSTRAINT FK_BEBACAEC537A1329 FOREIGN KEY (message_id) REFERENCES message (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message_chat_room ADD CONSTRAINT FK_BEBACAEC1819BCFA FOREIGN KEY (chat_room_id) REFERENCES chat_room (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE chat_rooms_users DROP FOREIGN KEY FK_E89A2BC41819BCFA');
        $this->addSql('ALTER TABLE message_chat_room DROP FOREIGN KEY FK_BEBACAEC1819BCFA');
        $this->addSql('ALTER TABLE chat_rooms_users DROP FOREIGN KEY FK_E89A2BC4A76ED395');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FF624B39D');
        $this->addSql('ALTER TABLE message_chat_room DROP FOREIGN KEY FK_BEBACAEC537A1329');
        $this->addSql('DROP TABLE chat_room');
        $this->addSql('DROP TABLE chat_rooms_users');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE message_chat_room');
    }
}
