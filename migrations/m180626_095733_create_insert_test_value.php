<?php

use yii\db\Migration;

/**
 * Class m180626_095733_create_insert_test_value
 */
class m180626_095733_create_insert_test_value extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('position', [
            'id'=> '1',
            'position'=>'founder',
        ]);

        $this->insert('position', [
            'id'=> '2',
            'position'=>'manager',
        ]);

        $this->insert('position', [
            'id'=> '3',
            'position'=>'developer',
        ]);

        $this->insert('position', [
            'id'=> '4',
            'position'=>'trainee',
        ]);


        $this->insert('user', [
            'name'=>'Mark Boss',
            'position_id'=>'1',
            'start_date'=>date('Y-m-d', strtotime('-5 week')),
            'salary'=>'20000'
        ]);

        $this->insert('user', [
            'name'=>'Tom Man',
            'position_id'=>'2',
            'start_date'=>date('Y-m-d', strtotime('-4 week')),
            'salary'=>'10000'
        ]);

        $this->insert('user', [
            'name'=>'Marta Green',
            'position_id'=>'2',
            'start_date'=>date('Y-m-d', strtotime('-4 week')),
            'salary'=>'10000'
        ]);

        $this->insert('user', [
            'name'=>'Lara Woo',
            'position_id'=>'3',
            'start_date'=>date('Y-m-d', strtotime('-3 week')),
            'salary'=>'5000'
        ]);

        $this->insert('user', [
            'name'=>'Robert Lee',
            'position_id'=>'3',
            'start_date'=>date('Y-m-d', strtotime('-2 week')),
            'salary'=>'4500'
        ]);

        $this->insert('user', [
            'name'=>'Nick Bee',
            'position_id'=>'4',
            'start_date'=>date('Y-m-d', strtotime('-1 week')),
            'salary'=>'2500'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180626_095733_create_insert_test_value cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180626_095733_create_insert_test_value cannot be reverted.\n";

        return false;
    }
    */
}
