<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\ForbiddenHttpException;
use yii\helpers\Url;

class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        return $this->render('index');
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionReport() {
        return $this->render('report');
    }
    
    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest)
            return $this->goHome();

        $model = new LoginForm();
        
        if ($model->load(Yii::$app->request->post()) && $model->login())
            return $this->goBack();
        
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact() {
        $model = new ContactForm();
        
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    
    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionMe() {
        if (!\Yii::$app->user->can('about'))
            throw new ForbiddenHttpException('Access denied');

        return $this->render('me');
    }
    
    public function beforeAction($action) {
        if (
            // если я гость
            Yii::$app->user->isGuest
            &&
            // и это не страница /login
            (Yii::$app->controller->action->id !== 'login')
        ) {
            $a = 123;
            return $this->redirect('site/login');
        }
        
        return parent::beforeAction($action);
    }

}
