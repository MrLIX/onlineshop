<?php

namespace app\controllers;

use app\models\About;
use app\models\Application;
use app\models\Carousel;
use app\models\Category;
use app\models\Contacts;
use app\models\forms\Login;
use app\models\Orders;
use app\models\OurService;
use app\models\OurServices;
use app\models\Phones;
use app\models\Rayon;
use app\models\Services;
use app\models\Sms;
use app\models\User;
use app\models\UserInfo;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\forms\ContactForm;
use yii\widgets\ActiveForm;

class SiteController extends Controller
{

    public function init()
    {

        if (!empty(Yii::$app->request->cookies['language'])) {
            Yii::$app->language = Yii::$app->request->cookies['language'];
        } else {
            Yii::$app->language = 'ru';
        }
        parent::init();
    }

    /**
     * {@inheritdoc}
     */
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

//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'logout' => ['post'],
//                ],
//            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
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
    public function actionIndex()
    {
        $carousel = Carousel::find()
            ->orderBy(['order' => SORT_ASC])
            ->all();
        $services = OurServices::find()
            ->where(['status' => 1])
            ->orderBy(['id' => SORT_DESC])
            ->limit(4)
            ->all();
        $categories = Category::find()
            ->limit(4)
            ->all();
        $advantages = Services::find()
            ->where(['status' => 1])
            ->all();


        return $this->render('index', compact([
            'carousel',
            'services',
            'categories',
            'advantages',
        ]));
    }

    /**
     * Login
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->getUser()->isGuest) {
            return $this->goHome();
        }

        $model = new Login();
        if ($model->load(Yii::$app->getRequest()->post()) && $model->login()) {
            return $this->goBack();
        } else {
            Yii::$app->session->setFlash('loginError');
//            return $this->refresh();
            return $this->goBack();

        }
    }


    /**
     * @return bool|string
     */
    public function actionSignUp()
    {
        //Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
        //$this->layout = false;
        $username = Yii::$app->request->post('username');
        $password = Yii::$app->request->post('password');

        $user = new User();
        $user->username = $username;
        $user->setPassword($password);
        $user->status = 0;
        if ($user->save()) {
            return $this->renderAjax('sign-up-ajax',['user' => $user]);
        }

        return false;

    }

    /**
     * @return bool|int|string
     */
    public function actionGetCode() {


        // render code for sms masssage
        $code = mt_rand(1000, 9999);

        $phone = Yii::$app->request->post('phone');
        $user_id = Yii::$app->request->post('id');
        $user = User::findOne($user_id);

        $user_info = new UserInfo();                // create User Info
        $user_info->user_id = $user_id;
        $user_info->phone = $phone;

        $sms = new Sms();                           // create SMS
        $sms->phone = $phone;
        $sms->sms = $code;                          // example sms = 1 || change
        $sms->send_at = time();
        $phone = substr($phone,1,12);    // format to 9989X XXX XXXX
        if ($user_info->save(false) && $sms->save(false) && Yii::$app->user->login($user)) {
            $sms->sendSMS($code,$phone);
            return $sms->id;
        }
    }

    /**
     * @return int
     */
    public function actionOrderGetCode() {

        // render code for sms masssage
        $code = mt_rand(1000, 9999);

        $phone = Yii::$app->request->get('phone');

        $sms = new Sms();                       // create SMS
        $sms->phone = $phone;
        $sms->sms = $code;                      // example sms = 1 || change
        $sms->send_at = time();
        $phone = substr($phone,1,12);    // format to 9989X XXX XXXX

        if ($sms->save(false)) {
            $sms->sendSMS($code,$phone);
            return $sms->id;
        }
    }


    /**
     * @return bool|int|Response
     */
    public function actionGetSms()
    {
        $sms = Yii::$app->request->get('sms');
        $sms = Sms::findOne($sms);
        $user_id = Yii::$app->request->get('id');
        $code = Yii::$app->request->get('code');
        $user = User::findOne($user_id);
        if(!empty($sms)){

            if($code == $sms->sms){

                $user = User::findOne($user_id);
                $user->status = 10;
                $user->save(false);
                Yii::$app->user->login($user);
                return $this->goHome();
            } else{
                return 2;
            }

        }
        return false;

    }

    /**
     * @return bool|int|Response
     */

    /**
     * Logout
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->getUser()->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContacts()
    {
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
    public function actionAbout()
    {
        $about = About::find()->where(['id' => 1])->one();

        return $this->render('about', ['about' => $about]);
    }

    /**
     * @return string
     */
    public function actionDelivery()
    {
        $about = About::find()->where(['id' => 2])->one();

        return $this->render('delivery', ['about' => $about]);
    }

    /**
     * @return string
     */
    public function actionOurServices()
    {
        $our_service = OurService::find()->where(['id' => 1])->one();
        $our_services = OurServices::find()->where(['status' => 1])->all();
        return $this->render('our-services', compact([
            'our_service',
            'our_services',
        ]));
    }

    /**
     * @param $lang
     * @return Response
     */
    public function actionSetLanguage($lang)
    {
        $l = $lang;
        $langs = ['en', 'ru'];
        if (in_array($l, $langs)) {
            \Yii::$app->language = $l;
            Yii::$app->session->set('app_lang', $l);
            $cookies = Yii::$app->response->cookies;
            $cookies->add(new \yii\web\Cookie([
                'name' => 'language',
                'value' => $l,
            ]));
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * @return string
     */
    public function actionContact()
    {
        $contact = Contacts::find()->where(['id' => 1])->one();
        $phones = Phones::find()->all();
        return $this->render('contacts', compact([
            'contact',
            'phones'
        ]));
    }

    /**
     * @return string
     */
    public function actionCabinet(){
        $user_id = Yii::$app->user->id;

        $orders = Orders::find()->where(['user_id' => $user_id])->all();
        $user = User::findOne($user_id);
        $user_info = UserInfo::find()->where(['user_id' => $user_id])->one();

        return $this->render('cabinet', compact([
            'user',
            'user_info',
            'orders',
        ]));

    }

    /**
     * @return Response
     */
    public function actionApplication(){
        $name = Yii::$app->request->post('name');
        $email = Yii::$app->request->post('email');
        $massege = Yii::$app->request->post('massege');

        $app = new Application();
        $app->name = $name;
        $app->email = $email;
        $app->massege = $massege;
        if($app->save()){
          Yii::$app->session->setFlash('app',true);
            return $this->redirect(Yii::$app->request->referrer);
        }

    }

    /**
     * @return string
     */
    public function actionChangeUser()
    {

        $id = Yii::$app->user->id;
        $user = User::findIdentity($id);
        $user_info = UserInfo::find()->where(['user_id' => $id])->one();

        $phone = Yii::$app->request->get('phone');
        $username = Yii::$app->request->get('username');
        $name = Yii::$app->request->get('name');
        $emial = Yii::$app->request->get('email');
        if (Yii::$app->request->get()) {
            $user->username = $username;
            $user->email = $emial;
            $user_info->name = $name;
            $user_info->phone = $phone;
            if ($user_info->save(false) && $user->save(false)) {
                return $this->render('cabinet', compact([
                    'user',
                    'user_info',
                ]));
            } else {
                return 'error';
            }
        }


    }

    /**
     * @param $region_id
     * @return string
     */
    public function actionRegion($region_id)
    {
        //Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
        $this->layout = false;
        $rayon = Rayon::find()->where(['region_id' => $region_id])->all();
        $return = '';
        if (!empty($rayon)) {
            foreach ($rayon as $item) {
                $return .= '<option value="' . $item->id . '" >' . $item->rayon . '</option>';
            }
        } else {
            $return .= '<option> - </option>';
        }

        return $return;
    }

    /**
     * @return string
     */
    public function actionChangeAddress(){

        $rayon = Yii::$app->request->get('rayon');
        $index = Yii::$app->request->get('index');
        $street = Yii::$app->request->get('street');
        $n_dom = Yii::$app->request->get('number_dom');
        $n_kv = Yii::$app->request->get('number_kv');

        $user_id = Yii::$app->user->id;
        $user = User::findOne($user_id);

        $user_info = UserInfo::find()->where(['user_id'=> $user_id])->one();
        if(empty($user_info)){
            $user_info = new UserInfo();
            $user_info->user_id = $user_id;
        }
        $user_info->region_id = $rayon;
        $user_info->index = $index;
        $user_info->address = $street;
        $user_info->number_dom = $n_dom;
        $user_info->number_kv = $n_kv;
        if($user_info->save(false)){
            return $this->render('cabinet', compact([
                'user',
                'user_info',
            ]));
        }
    }

    /**
     * @return string
     */
    public function actionChangePassword()
    {
        $password = Yii::$app->request->get('password');
        $id = Yii::$app->request->get('id');

        if ($password) {
            $user = User::findOne($id);
            $user->setPassword($password);
            if ($user->save()) {
                $user_info = UserInfo::find()->where(['user_id' => $id])->one();
                $orders = Orders::find()->where(['user_id' => $id])->all();
                return $this->render('cabinet', compact([
                    'user',
                    'user_info',
                    'orders',
                ]));
            }
        } else {
            return $this->render('change-password', ['id' => $id]);
        }
    }
}
