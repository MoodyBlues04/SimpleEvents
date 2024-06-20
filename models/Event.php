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

    /**
     * @param \Closure $closure
     * @return array
     */
    public function mapOrganisers(\Closure $closure): array
    {
        return array_map($closure, $this->organisers);
    }

    public function hasOrganiser(Organiser|int|null $organiser): bool
    {
        if (is_int($organiser)) {
            $organiser = Organiser::findOne($organiser);
        }
        return in_array($organiser, $this->organisers);
    }
}