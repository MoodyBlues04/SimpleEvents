<?php

namespace app\controllers;

use app\models\forms\CreateOrganiserForm;
use app\helpers\IsAdmin;
use app\repositories\OrganiserRepository;
use yii\db\Exception;
use yii\db\StaleObjectException;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\web\Session;

class OrganiserController extends Controller
{
    private OrganiserRepository $organiserRepository;
    private Session $session;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->organiserRepository = new OrganiserRepository();
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
        $organisers = $this->organiserRepository->getAll();
        return $this->render('index', compact('organisers'));
    }

    public function actionCreate(): string|Response
    {
        if ($this->request->isPost) {
            $form = new CreateOrganiserForm();
            if ($form->load($this->request->post(), '') && $form->create()) {
                $this->session->setFlash('success', 'Organiser created');
            }
            return $this->redirect('/organiser/index');
        }
        return $this->render('create');
    }

    /**
     * @throws Exception
     * @throws \Throwable
     */
    public function actionUpdate()
    {
        if ($this->request->isPost) {
            $form = new CreateOrganiserForm();
            if ($form->load($this->request->post(), '') && $form->update()) {
                $this->session->setFlash('success', 'Organiser updated');
            }
            return $this->redirect('/organiser/index');
        }

        $organiserId = $this->request->get('id');
        $organiser = $this->organiserRepository->getOneBy(['id' => $organiserId]);
        if (is_null($organiser)) {
            $this->session->setFlash('error', 'Incorrect organiser id');
            return $this->redirect('/organiser/index');
        }

        return $this->render('update', compact('organiser'));
    }

    /**
     * @throws StaleObjectException
     * @throws \Throwable
     */
    public function actionDelete(): Response
    {
        $organiserId = $this->request->get('id');
        $organiser = $this->organiserRepository->getOneBy(['id' => $organiserId]);
        if (is_null($organiser)) {
            throw new \Exception('Incorrect organiser id');
        }
        $organiser->delete();
        return $this->redirect('/organiser/index');
    }
}