<?php

namespace app\controllers;

use app\models\forms\CreateEventForm;
use app\repositories\EventRepository;
use app\helpers\IsAdmin;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Request;
use yii\web\Response;
use yii\web\Session;

class EventController extends Controller
{
    private EventRepository $eventRepository;
    private Session $session;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->eventRepository = new EventRepository();
        $this->session = \Yii::$app->getSession();
    }

    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'show', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['index', 'show', 'create', 'update', 'delete'],
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

    public function actionShow(): string
    {
        $eventId = $this->request->get('id');
        $event = $this->eventRepository->getOneBy(['id' => $eventId]);
        if (is_null($event)) {
            $this->session->setFlash('error', 'Incorrect event id');
        }
        return $this->render('show', compact('event'));
    }

    public function actionCreate(): string|Response
    {
        if ($this->request->isPost) {
            $form = new CreateEventForm();
            if ($form->load($this->request->post(), '') && $form->create()) {
                $this->session->setFlash('success', 'Event created');
            }
            return $this->redirect('/event/index');
        }
        return $this->render('create');
    }

    public function actionUpdate()
    {

    }

    public function actionDelete()
    {

    }
}