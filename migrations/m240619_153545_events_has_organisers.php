<?php

use yii\db\Migration;

/**
 * Class m240619_153545_events_has_organisers
 */
class m240619_153545_events_has_organisers extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%events_has_organisers}}', [
            'event_id' => $this->integer()->notNull(),
            'organiser_id' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey(
            'event_id_foreign_key',
            'events_has_organisers',
            'event_id',
            'events',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'organiser_id_foreign_key',
            'events_has_organisers',
            'organiser_id',
            'organisers',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('event_id_foreign_key', 'events_has_organisers');
        $this->dropForeignKey('organiser_id_foreign_key', 'events_has_organisers');
        $this->dropTable('{{%events_has_organisers}}');
    }
}
