<?php

namespace app\controllers;

use app\repositories\EventRepository;
use app\repositories\OrganiserRepository;
use yii\filters\AccessControl;
use yii\web\Controller;

class IndexController extends Controller
{
    private EventRepository $eventRepository;
    private OrganiserRepository $organiserRepository;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->eventRepository = new EventRepository();
        $this->organiserRepository = new OrganiserRepository();
    }

    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions(): array
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex(): string
    {
        $events = $this->eventRepository->getAll();
        $organisers = $this->organiserRepository->getAll();

        return $this->render('index', compact('events', 'organisers'));
    }
}