<?php

namespace app\controllers;

use app\repositories\EventRepository;
use app\helpers\IsAdmin;
use yii\filters\AccessControl;
use yii\web\Controller;

class EventController extends Controller
{
    private EventRepository $eventRepository;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->eventRepository = new EventRepository();
    }

    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'delete'],
                        'allow' => true,
//                        too small project for rbac
                        'matchCallback' => function ($rule, $action) {
                            return IsAdmin::check();
                        }
                    ],
                ],
            ],
        ];
    }

    public function actionIndex(): string
    {
        $events = $this->eventRepository->getAll();
        return $this->render('index', compact('events'));
    }
}