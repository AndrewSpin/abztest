<?php

use yii\db\Migration;

/**
 * Class m180626_121354_add_columns_to_user
 */
class m180626_121354_add_columns_to_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'photo', $this->string());
        $this->addColumn('user', 'login', $this->string(10));
        $this->addColumn('user', 'password', $this->string(200));

        $this->insert('user', [
            'name'=>'Adam New',
            'position_id'=>'1',
            'start_date'=>date('Y-m-d'),
            'salary'=>'2500',
            'login'=>'admin',
            'password' => \app\models\User::encrypt('admin'),
            'photo' => '/web/img/adam.jpg',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180626_121354_add_columns_to_user cannot be reverted.\n";

        return false;
    }

}
