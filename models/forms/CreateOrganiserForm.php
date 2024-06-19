<?php

namespace app\models\forms;

use app\models\Organiser;
use yii\base\Model;
use yii\db\Exception;

class CreateOrganiserForm extends Model
{
    public ?int $id = null;
    public string $fio = '';
    public string $email = '';
    public ?string $phone = null;

    public function rules(): array
    {
        return [
            [['id'], 'integer'],
            [['fio', 'email'], 'required'],
            [['fio', 'email', 'phone'], 'string'],
        ];
    }

    /**
     * @throws Exception
     */
    public function create(): ?Organiser
    {
        $organiser = new Organiser([
            'fio' => $this->fio,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);
        return $organiser->save() ? $organiser : null;
    }

    /**
     * @throws Exception
     * @throws \Throwable
     */
    public function update(): bool
    {
        /** @var Organiser $organiser */
        $organiser = Organiser::findOne($this->id);
        if (is_null($organiser)) {
            throw new Exception('Incorrect user id');
        }
        $organiser->fio = $this->fio;
        $organiser->email = $this->email;
        $organiser->phone = $this->phone;
        return $organiser->save();
    }
}