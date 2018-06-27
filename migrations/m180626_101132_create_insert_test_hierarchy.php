<?php

use yii\db\Migration;

/**
 * Class m180626_101132_create_insert_test_hierarchy
 */
class m180626_101132_create_insert_test_hierarchy extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('hierarchy', [
            'chief_user_id'=>'1',
            'subordinate_user_id'=>'2',
        ]);

        $this->insert('hierarchy', [
            'chief_user_id'=>'1',
            'subordinate_user_id'=>'3',
        ]);

        $this->insert('hierarchy', [
            'chief_user_id'=>'2',
            'subordinate_user_id'=>'4',
        ]);

        $this->insert('hierarchy', [
            'chief_user_id'=>'3',
            'subordinate_user_id'=>'5',
        ]);

        $this->insert('hierarchy', [
            'chief_user_id'=>'5',
            'subordinate_user_id'=>'6',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180626_101132_create_insert_test_hierarchy cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180626_101132_create_insert_test_hierarchy cannot be reverted.\n";

        return false;
    }
    */
}
