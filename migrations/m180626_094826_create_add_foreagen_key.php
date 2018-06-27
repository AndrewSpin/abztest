<?php

use yii\db\Migration;

/**
 * Class m180626_094826_create_add_foreagen_key
 */
class m180626_094826_create_add_foreagen_key extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('fk_position', 'user', 'position_id', 'position', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180626_094826_create_add_foreagen_key cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180626_094826_create_add_foreagen_key cannot be reverted.\n";

        return false;
    }
    */
}
