<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%events}}`.
 */
class m240619_152611_create_events_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%events}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(64)->notNull(),
            'date' => $this->date()->notNull(),
            'description' => $this->text()->null(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%events}}');
    }
}
