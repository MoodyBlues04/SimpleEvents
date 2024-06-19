<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m240619_161142_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(32)->notNull(),
            'email' => $this->string(32)->unique()->notNull(),
            'password' => $this->string()->notNull(),
            'auth_key' => $this->string(32)->notNull(),
            'email_verify_token' => $this->string(32)->null(),
            'email_verified_at' => $this->dateTime()->null(),
            'is_admin' => $this->boolean()->defaultValue(false),
        ]);

        $this->createIndex('idx_user_username', '{{%users}}', 'username', true);
        $this->createIndex('idx_user_email', '{{%users}}', 'email', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
