<?php

namespace app\models;

use yii\base\InvalidConfigException;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $fio
 * @property string $email
 * @property string $phone
 *
 * @property Event[] $events
 */
class Organiser extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%organisers}}';
    }

    /**
     * @return ActiveQuery
     * @throws InvalidConfigException
     */
    public function getEvents(): ActiveQuery
    {
        return $this->hasMany(Event::class, ['id' => 'event_id'])
            ->viaTable('events_has_organisers', ['organiser_id' => 'id']);
    }
}