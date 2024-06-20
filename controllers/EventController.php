<?php

namespace app\controllers;

use app\models\forms\CreateEventForm;
use app\models\forms\CreateOrganiserForm;
use app\repositories\EventRepository;
use app\helpers\IsAdmin;
use app\repositories\OrganiserRepository;
use yii\db\Exception;
use yii\db\StaleObjectException;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Request;
use yii\web\Response;
use yii\web\Session;

class EventController extends Controller
{
    private EventRepository $eventRepository;
    private OrganiserRepository $organiserRepository;
    private Session $session;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->eventRepository = new EventRepository();
        $this->organiserRepository = new OrganiserRepository();
        $this->session = \Yii::$app->getSession();
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

    /**
     * @throws Exception
     */
    public function actionCreate(): string|Response
    {
        if ($this->request->isPost) {
            $form = new CreateEventForm();
            if ($form->load($this->request->post(), '') && $form->create()) {
                $this->session->setFlash('success', 'Event created');
            }
            return $this->redirect('/event/index');
        }
        $organisers = $this->organiserRepository->getAll();
        return $this->render('create', compact('organisers'));
    }

    /**
     * @throws Exception
     * @throws \Throwable
     */
    public function actionUpdate(): Response|string
    {
        if ($this->request->isPost) {
            $form = new CreateEventForm();
            if ($form->load($this->request->post(), '') && $form->update()) {
                $this->session->setFlash('success', 'Event updated');
            }
            return $this->redirect('/event/index');
        }

        $eventId = $this->request->get('id');
        $event = $this->eventRepository->getOneBy(['id' => $eventId]);
        if (is_null($event)) {
            $this->session->setFlash('error', 'Incorrect event id');
            return $this->redirect('/event/index');
        }

        $organisers = $this->organiserRepository->getAll();
        return $this->render('update', compact('event', 'organisers'));
    }

    /**
     * @throws StaleObjectException
     * @throws \Throwable
     */
    public function actionDelete(): Response
    {
        $eventId = $this->request->get('id');
        $event = $this->eventRepository->getOneBy(['id' => $eventId]);
        if (is_null($event)) {
            throw new \Exception('Incorrect event id');
        }
        $event->delete();
        return $this->redirect('/event/index');
    }
}