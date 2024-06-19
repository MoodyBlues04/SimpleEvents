<?php

namespace app\models;

use yii\base\InvalidConfigException;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $name
 * @property string $date
 * @property string|null $description
 *
 * @property Organiser[] $organisers
 */
class Event extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%events}}';
    }

    /**
     * @return ActiveQuery
     * @throws InvalidConfigException
     */
    public function getOrganisers(): ActiveQuery
    {
        return $this->hasMany(Organiser::class, ['id' => 'organiser_id'])
            ->viaTable('events_has_organisers', ['event_id' => 'id']);
    }
}