<?php

namespace app\repositories;

use app\models\Event;

class EventRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(Event::class);
    }
}