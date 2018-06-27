<?php

use yii\db\Migration;

/**
 * Handles the creation of table `position`.
 */
class m180626_093806_create_position_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('position', [
            'id' => $this->primaryKey(),
            'position' => $this->string('15'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('position');
    }
}
