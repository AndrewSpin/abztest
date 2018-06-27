<?php

use yii\db\Migration;

/**
 * Handles the creation of table `hierarchy`.
 */
class m180626_094014_create_hierarchy_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('hierarchy', [
            'id' => $this->primaryKey(),
            'chief_user_id' => $this->integer(),
            'subordinate_user_id' => $this->integer(),
        ]);

        $this->addForeignKey('fk_chief', 'hierarchy', 'chief_user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_subordinate', 'hierarchy', 'subordinate_user_id', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('hierarchy');
    }
}
