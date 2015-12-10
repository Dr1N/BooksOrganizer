<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

use app\components\SessionAction;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
            'mysess' => [
                'class' => SessionAction::className(),
            ],
        ];
    }
    
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $this->redirect(\Yii::$app->urlManager->createUrl("books"));
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        if (\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        Yii::$app->user->logout();

        if(Yii::$app->session->has('searchForm'))
        {
            Yii::$app->session->remove('searchForm');
        }

        if (Yii::$app->session->has('absoluteUrl')) 
        {
            Yii::$app->session->remove('absoluteUrl');
        }

        return $this->goHome();
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) 
        {
            return $this->render('error', ['exception' => $exception]);
        }
    }

    public function actionTest()
    {
        $tmp = new SessionAction(['except' => ['index', 'update']]);
        var_dump($tmp);
    }
}