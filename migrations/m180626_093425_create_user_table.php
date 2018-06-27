<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m180626_093425_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100),
            'position_id' => $this->integer(),
            'start_date' => $this->date(),
            'salary' => $this->integer(15),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }
}
