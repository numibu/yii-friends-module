<?php

use yii\db\Migration;

/**
 * Handles the creation of table `friends`.
 */
class m161120_160147_create_friends_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        // create table of users relations
        $this->createTable('{{%friends}}', [
            'initiator_id' => $this->integer()->notNull(),
            'initiated_id' => $this->integer()->notNull(),
        ]);
        
        // creates index for column `initiator_id`
        $this->createIndex(
            'idx-friends-initiator_id',
            'friends',
            'initiator_id'
        );

        // add foreign key for table `user` user.id <--- friends.initiator_id
        $this->addForeignKey(
            'fk-friends-initiator_id',
            'friends',
            'initiator_id',
            'user',
            'id',
            'CASCADE'
        );
        
        // creates index for column `initiated_id`
        $this->createIndex(
            'idx-friends-initiated_id',
            'friends',
            'initiated_id'
        );

        // add foreign key for table `user` user.id <--- friends.initiated_id
        $this->addForeignKey(
            'fk-friends-initiated_id',
            'friends',
            'initiated_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%friends}}');
    }
}
