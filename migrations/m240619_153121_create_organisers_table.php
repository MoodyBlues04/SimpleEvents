<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%organisers}}`.
 */
class m240619_153121_create_organisers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%organisers}}', [
            'id' => $this->primaryKey(),
            'fio' => $this->string(64)->notNull(),
            'email' => $this->string(32)->unique()->notNull(),
            'phone' => $this->string(32)->null(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%organisers}}');
    }
}
