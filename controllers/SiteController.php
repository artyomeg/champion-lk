<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use yii\helpers\Url;

use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;
use app\models\Card;

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
     * Личный кабинет - Главная.
     *
     * @return string
     */
    public function actionIndex() {
        return $this->render('index');
    }
    
    /**
     * Регистрация
     * 
     * @return type
     */
    public function actionSignup() {
        $model = new SignupForm();

        // если модель загрузилась из $_POST
        if ($model->load(Yii::$app->request->post()))
            // если юзер присвоился
            if ($user = $model->signup())
                // если мы залогинились
                if (Yii::$app->getUser()->login($user))
                    return $this->goHome();

        return $this->render('signup', [
                    'model' => $model,
        ]);
    }

    public function actionSetcards() {
//        ob_start();
//        var_dump($_POST);
//        $output = ob_get_clean();
//        file_put_contents('log.php', $output);
        
//        $test = '{"card_id":["7331111000997","7331111018800","7331111003981","7331111010996","7331111021091"],"fio":["Крылова Анастасия Игоревна","Нестерова Наталья Эдуардовна",'
//                . '"Гринчук Елена Анатольевна","Батманов подарок 4","Иванова Виктория Дмитриевна"],"last_operation":["Реализация товаров и услуг 00000005138 от 21.09.2016 17:40:27",'
//                . '"Реализация товаров и услуг 00000005917 от 16.04.2017 12:55:29","Реализация товаров и услуг 00000002698 от 14.07.2016 19:13:34",'
//                . '"Реализация товаров и услуг 00000009328 от 30.12.2016 8:20:36","Реализация товаров и услуг 00000005564 от 10.04.2017 8:50:16"]}';
//        $response = json_decode($test, true);
        
        $response = json_decode($_POST["JSONdata"], true);

        if (!empty($response))
            foreach ($response['card_id'] as $i => $card_id) {
                $card = Card::find()->where(['card_id' => $card_id])->one();
                
                if ($card)
                    $card->delete();
                
                $card = new Card;
                $card->card_id = $card_id;
                $card->fio = $response['fio'][$i];
                $card->last_operation = $response['last_operation'][$i];
                $card->save();
            }
//        return $this->render('showcards');
    }
    
    public function actionShowcards() {
        return $this->render('showcards');
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
    
    public function beforeAction($action) {
        $this->enableCsrfValidation = ($action->id !== "setcards"); 
        
        $actionId = Yii::$app->controller->action->id;
        
        // если я гость
        if (
            Yii::$app->user->isGuest) {
            // и это не страница /login и не страница showcards
            if (
                (($actionId !== 'login')
                && ($actionId !== 'signup')
                && ($actionId !== 'showcards')
                && ($actionId !== 'setcards'))
            ) {
                return $this->redirect('login');
            }
        }
            
        
        return parent::beforeAction($action);
    }
}
