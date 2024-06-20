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
            [['id'], 'integer'],
            [['organisers'], 'validateOrganisers'],
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

        if (!$event->save()) {
            return null;
        }

        foreach ($this->organisers as $organiserId) {
            $event->link('organisers', Organiser::findOne($organiserId));
        }
        return $event;
    }

    /**
     * @throws \Throwable
     */
    public function update(): bool|int
    {
        $event = Event::findOne($this->id);
        if (is_null($event)) {
            throw new \Exception('Incorrect event id');
        }

        $event->name = $this->name;
        $event->date = $this->date;
        $event->description = $this->description;

        $event->unlinkAll('organisers', true);
        foreach ($this->organisers as $organiserId) {
            $event->link('organisers', Organiser::findOne($organiserId));
        }

        return $event->update();
    }

    public function validateOrganisers(): void
    {
        if ($this->hasErrors()) {
            return;
        }

        foreach ($this->organisers as $organiserId) {
            if (is_null(Organiser::findOne($organiserId))) {
                $this->addError('organisers', "Incorrect organiser id: $organiserId.");
                return;
            }
        }
    }
}