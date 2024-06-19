<?php

namespace app\models\forms;

use app\models\Event;
use app\models\Organiser;
use yii\base\Model;
use yii\db\Exception;

class CreateEventForm extends Model
{
    public ?int $id = null;
    public string $name = '';
    public string $date = '';
    /** @var int[]  */
    public array $organisers = [];
    public ?string $description = null;

    public function rules(): array
    {
        return [
            [['name', 'date', 'organisers'], 'required'],
            ['id', 'integer'],
//            ['organisers', 'array'],
            [['name', 'description', 'date'], 'string'],
            [['date'], 'date', 'format' => 'php:Y-m-d']
        ];
    }

    /**
     * @throws Exception
     */
    public function create(): ?Event
    {
        $event = new Event([
            'name' => $this->name,
            'date' => $this->date,
            'description' => $this->description
        ]);
        foreach ($this->organisers as $organiserId) {
            // todo validate in rules (like in login)
            $event->link('organisers', Organiser::findOne($organiserId)); // TODO check
        }
        return $event->save() ? $event : null;
    }

    public function update(): bool|int
    {
        return false;
//        $event = Event::findOne($this->id);
//        $event->name = $this->name;
//        $event->description = $this->description;
//        return $event->update();
    }
}