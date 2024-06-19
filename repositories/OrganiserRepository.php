<?php

namespace app\repositories;

use app\models\Organiser;

class OrganiserRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(Organiser::class);
    }
}