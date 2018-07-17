<?php
/**
 * Created by PhpStorm.
 * User: SoS
 * Date: 19.06.2018
 * Time: 14:11
 */

namespace app\controllers;


use app\models\Category;
use app\models\Colors;
use app\models\DeliveryPrice;
use app\models\OrderProducts;
use app\models\Orders;
use app\models\PaymentMethod;
use app\models\Products;
use app\models\Sms;
use app\models\SubCategory;
use app\models\Types;
use app\models\User;
use app\models\UserFavorites;
use app\models\UserInfo;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\forms\ContactForm;

class ProductController extends Controller
{
    /**
     *  LANGUAGE -  COOKIE['LANGUAGE']
     */
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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
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
     * @param $id
     * @return string
     */
    public function actionCategory($id){
        $cat = Category::findOne($id);
        $category = SubCategory::find()
            ->where(['category_id' => $id,'status' => 1])
            ->all();

        return $this->render('category',compact([
            'cat',
            'category',
        ]));

    }

    /**
     * @param $id
     * @return string
     */

    public function actionSubCategory($id){

        $colors = Colors::find()
            ->where(['status' => 1])
            ->all();
        $types = Types::find()
            ->where(['status' => 1])
            ->all();
        $category = SubCategory::findOne($id);

        $query = Products::find()
            ->where(['category_id' => $id]);
        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 6,
            'forcePageParam' => false,
            'pageSizeParam' => false
        ]);
        $products = $query
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('products', compact([
            'category',
            'products',
            'pages',
            'colors',
            'types',
        ]));

    }


    /**
     * @return string
     *
     * Filter Sub Category
     * Search by @q     - GET 'q'
     * Filter by @new   - GET 'news'
     * Filter by @types - GET 'types'
     * Filter by @color - GET 'color'
     *
     */
    public function actionFilterAjax(){

        $id = Yii::$app->request->get('id');
        $q = Yii::$app->request->get('q');
        $new = Yii::$app->request->get('news');
        $type = Yii::$app->request->get('type');
        $color = Yii::$app->request->get('color');

        $query = Products::find()
            ->filterWhere(['category_id' => $id])
            ->andFilterWhere(['like','color_id',$color])
            ->andFilterWhere(['like','type_id', $type]);
        if(Yii::$app->language == 'ru'){
            $query = $query->andFilterWhere(['like','title_ru', $q]);
        } else{
            $query = $query->andFilterWhere(['like','title_en', $q]);
        }

        if($new == 'on'){
            $query = $query->orderBy(['id' => SORT_DESC]);
        } else{
            $query = $query->orderBy(['id' => SORT_ASC]);
        }


        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 6,
            'forcePageParam' => false,
            'pageSizeParam' => false
        ]);
        $products = $query
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();


        return $this->renderAjax('products-ajax', compact([
            'products',
            'pages',
        ]));
    }

    /**
     * @param $id
     * @return string
     */
    public function actionProduct($id){

        $product = Products::findOne($id);

        $color = \yii\helpers\Json::decode($product->color_id);
        $colors = Colors::findAll($color);

        $type = \yii\helpers\Json::decode($product->type_id);
        $types = Types::findAll($type);

        $count = \yii\helpers\Json::decode($product->buy_count);

        $payment = PaymentMethod::find()->where(['status' => 1])->all();

        $most = Products::find()
            ->where(['category_id' => $product->subCategory->category_id])
            ->limit(3)
            ->all();

        return $this->render('product', compact([
            'product',
            'colors',
            'types',
            'count',
            'payment',
            'most',
        ]));
    }

    /*
     * ADD Product to Favorites
     * if User isGUEST add to SESSION['favorites']
     * else add to table user_favorites
     * */
    public function actionAddFavorites(){

        $product_id = Yii::$app->request->get('product_id');

        if(Yii::$app->user->isGuest){
            $session = Yii::$app->session;
            $session->open();

            $favorite = new UserFavorites();
            if ($favorite->addFavorites($product_id) == true ){ // Add to SESSION['favorites']
                $favorites_count = $_SESSION['favorites'];
                return count($favorites_count);     // return favorites count
            } else{
                return '-1';   // если товар не добавлен в избранные
            }


        } else{
            $user_id = Yii::$app->user->id;
            $favorites = UserFavorites::find()
                ->where(['user_id' => $user_id, 'product_id' => $product_id])
                ->one();
            if(empty($favorites)){             //проверяем, если нет в базе то запишем
               $favorites = new UserFavorites();
               $favorites->product_id = $product_id;
               $favorites->user_id = $user_id;
               if($favorites->save(false)){         // сохраняем сразу в базу
                   $favorites_count = UserFavorites::find()
                       ->where(['user_id' => $user_id])
                       ->all();
                   return  count($favorites_count);   // return favorites count
               }
            } else{
                return true;
            }
        }


        return false;
    }

    /*
     * DELETE PRODUCT from favorites
     * If User isGUEST delete from SESSION['favorites']
     * Else delete from table user_favorites
     *
     * */
    public function actionDelFavorites(){
        $product_id = Yii::$app->request->get('product_id');
        if(Yii::$app->user->isGuest){

            $favorite = new UserFavorites();
            $favorite->delFavorites($product_id);  // delete from SESSION['favorites']

            $favorites_count = $_SESSION['favorites'];
            return count($favorites_count);     // return favorites count
        } else{
            $user_id = Yii::$app->user->id;
            UserFavorites::deleteAll(['user_id' => $user_id, 'product_id' => $product_id]);
            $favorites_count = UserFavorites::find()
                ->where(['user_id' => $user_id])
                ->all();
            return  count($favorites_count);   // return favorites count

        }
        return false;



    }

    /*
     *  Page Favorites for Users and Guest
     */
    public function actionFavorites(){


        if (Yii::$app->user->isGuest) {
            $session = Yii::$app->session['favorites'];
            if (!empty($session)) {

                $favs = $_SESSION['favorites'];
                $count = count($favs);
                $query = Products::find()->where(['in', 'id', $favs]);
                $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 6, 'forcePageParam' => false, 'pageSizeParam' => false]);
                $favorites = $query->offset($pages->offset)->limit($pages->limit)->all();
            }
        } else{
                $favs = ArrayHelper::getColumn(UserFavorites::find()->select('product_id')
                    ->where(['user_id' => Yii::$app->user->id])->all(), 'product_id');

                $query = Products::find()->where(['in', 'id', $favs]);
                $count = $query->count();
                $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 8, 'forcePageParam' => false, 'pageSizeParam' => false]);
                $favorites = $query->offset($pages->offset)->limit($pages->limit)->all();
        }



        return $this->render('favorites', compact([
            'favorites',
            'count',
            'pages'
        ]));

    }

    /*
     *  Add product to SESSION CART from ID
     */
    public function actionAddToCard(){

        $id_product = Yii::$app->request->get('id');
        $product = Products::findOne($id_product);
        $color = Yii::$app->request->get('color');
        $color = Colors::findOne($color);
        $type = Yii::$app->request->get('type');
        $type = Types::findOne($type);
        $qty = Yii::$app->request->get('count');

        if (empty($product)) return false; // елси пусто
        $cart = new Products();
        if($cart->addToCart($product, $color, $type, $qty)){
           $count = Yii::$app->session['cart'];
           $count = count($count);
           return $count;
        }

    }

    /**
     * @return string
     */
    public function actionCart(){

        $session = Yii::$app->session['cart'];

        $most = Products::find()
            ->orderBy(['id' => SORT_DESC])
            ->limit(3)
            ->all();
        $delivery_price = DeliveryPrice::find()
            ->orderBy(['order' => SORT_ASC])
            ->all();

        return $this->render('cart',compact([
            'session',
            'most',
            'delivery_price',
        ]));


    }

    /**
     * @return bool
     */
    public function actionDelFromCart(){
        $product_id = Yii::$app->request->get('id');
        $color = Yii::$app->request->get('color');
        $type = Yii::$app->request->get('type');

        $cart = new Products();
        $cart->recalc($product_id, $color, $type);
        return true;

    }

    /**
     * @return Response
     */
    public function actionRemoveCart(){
        unset($_SESSION['cart.sum']);
        unset($_SESSION['cart.qty']);
        unset($_SESSION['cart']);
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * @return array|bool|mixed
     */
    public function actionChangeProdQty(){
        $product_id = Yii::$app->request->get('id');
        $product = Products::findOne($product_id);

         if (empty($product)) return false; // елси пусто
        $color = Yii::$app->request->get('color');
        $type = Yii::$app->request->get('type');
        $qty = Yii::$app->request->get('value');
        $cart = new Products();
        $cart->recalc($product_id, $color, $type);

        if($cart->changeQtyCart($product, $color, $type, $qty)){
            $count = Yii::$app->session['cart'];
            $count = count($count);
            return $qty;
        }

        return false;

    }


    /**
     * @return string
     */
    public function actionChangeProd(){
        $product_id = Yii::$app->request->get('id');
        $color = Yii::$app->request->get('color');
        $type = Yii::$app->request->get('type');
        $cart = new Products();
        $cart->recalc($product_id, $color, $type);     // Удаляем продукт из Сессии

        $product = Products::findOne($product_id);

        $color = \yii\helpers\Json::decode($product->color_id);
        $colors = Colors::findAll($color);

        $type = \yii\helpers\Json::decode($product->type_id);
        $types = Types::findAll($type);

        $count = \yii\helpers\Json::decode($product->buy_count);
        $payment = PaymentMethod::find()->where(['status' => 1])->all();

        $most = Products::find()
            ->where(['category_id' => $product->subCategory->category_id])
            ->limit(3)
            ->all();

        return $this->render('product', compact([
            'product',
            'colors',
            'types',
            'count',
            'payment',
            'most',
        ]));
    }

    // Order -1-  INFO
    public function actionOrderInfo(){
        if(Yii::$app->user->isGuest){
            return $this->render('order-info');

        } else {
            $user_id = Yii::$app->user->id;
            $user_info = UserInfo::find()->where(['user_id' => $user_id])->one();
            return $this->render('order-info', compact([
                'user_info',
            ]));
        }
    }

    // if User is GUEST Chack sms code
    public function actionOrderGetSms()
    {
        $sms = Yii::$app->request->get('sms');
        $name = Yii::$app->request->get('name');
        $phone = Yii::$app->request->get('phone');
        $code = Yii::$app->request->get('code');

        $sms = Sms::findOne($sms);

        if(!empty($sms)){

            if($code == $sms->sms){
                $order = new Orders();
                $order->name = $name;
                $order->phone = $phone;
                if($order->save(false)){
                    $order_id = $order->id;
                    return Url::to(['/product/order-address', 'order_id' =>$order_id ]);
                } else{
                    return 'Error';
                }
            } else{
                return 2;
            }

        }
        return false;

    }

    // button 'вернуться' from order-address to order-info
    public function actionOrderInfoReturn(){
        $order_id = Yii::$app->request->get('order_id');
        $order = Orders::findOne($order_id);

        if(Yii::$app->request->get('name')){
            $name = Yii::$app->request->get('name');
            $phone = Yii::$app->request->get('phone');
            $order->name = $name;
            $order->phone = $phone;
            if($order->save(false)){
                if(!Yii::$app->user->isGuest){
                $user_id = Yii::$app->user->id;
                $user_info = UserInfo::findOne(['user_id' => $user_id]);
                }
                return $this->render('order-address', compact([
                    'order_id',
                    'user_info',
                ]));
            }

        }
        return $this->render('order-info-return', ['order' => $order]);

    }

    //Order -2- ADDRESS
    public function actionOrderAddress(){

        $name = Yii::$app->request->get('name');
        $phone = Yii::$app->request->get('phone');
        $order = new Orders();
        $order->name = $name;
        $order->phone = $phone;
        $user_id = Yii::$app->user->id;
        $user_info = UserInfo::findOne(['user_id' => $user_id]);
        if($order->save(false)){
            $order_id = $order->id;
            return $this->render('order-address', compact([
                'order_id',
                'user_info',
            ]));
        } else{
            return 'Error';
        }
    }

    // button 'вернуться' from order-payment to order-address
    public function actionOrderAddressReturn(){
        $order_id = Yii::$app->request->get('order_id');
        $order = Orders::findOne($order_id);
        return $this->render('order-address-return', compact([
            'order_id',
            'order',
        ]));

    }

    //Order -3- Payment Method
    public function actionOrderPayment(){

        $order_id = Yii::$app->request->get('order_id');
        $region_id = Yii::$app->request->get('rayon');
        $street = Yii::$app->request->get('street');
        $index = Yii::$app->request->get('index');
        $number_dom = Yii::$app->request->get('number_dom');
        $number_kv = Yii::$app->request->get('number_kv');
        $lat = Yii::$app->request->get('lat');
        $lng = Yii::$app->request->get('lng');
        $order = Orders::findOne($order_id);
            $order->region_id   = $region_id;
            $order->street      = $street;
            $order->index       = $index;
            $order->number_dom  = $number_dom;
            $order->number_kv   = $number_kv;
            $order->lat         = $lat;
            $order->lang        = $lng;

        if($order->save(false)){
            $payments = PaymentMethod::find()
                ->where(['status' => 1])
                ->all();
            $delivery_price = DeliveryPrice::find()
                ->orderBy(['order' => SORT_ASC])
                ->all();
            return $this->render('order-payment',compact([
                'order_id',
                'payments',
                'delivery_price',
            ]));
        } else{
            return 'ERROR 404';
        }

    }

    // button 'вернуться' from order-result to order-payment
    public function actionOrderPaymentReturn(){

        $order_id = Yii::$app->request->get('order_id');
        $payments = PaymentMethod::find()
            ->where(['status' => 1])
            ->all();
        $delivery_price = DeliveryPrice::find()
            ->orderBy(['order' => SORT_ASC])
            ->all();
        return $this->render('order-payment',compact([
            'order_id',
            'payments',
            'delivery_price',
        ]));
    }

    //Order -4- Result
    public function actionOrderResult(){
        $order_id = Yii::$app->request->get('order_id');
        $payment = Yii::$app->request->get('payment');
        $order = Orders::findOne($order_id);
        $order->payment_id = $payment;
        if($order->save(false)){
            $session = Yii::$app->session['cart'];
            return $this->render('order-result', compact([
                'session',
                'order_id',
                'order',
            ]));
        }
    }

    //Order -5- Finish
    public function actionOrderFinish(){


        $id = Yii::$app->request->get('order_id');
        $order = Orders::findOne($id);
        $session = Yii::$app->session['cart'];
        if(!empty($session)){
           $this->saveOrderItems($session, $id);       // Запис всех продуктов в таблице order_products
        }
        $order->state = 1;
        $order->amount = Yii::$app->session['cart.sum'] + Yii::$app->session['cart.delivery'];
        if(!Yii::$app->user->isGuest){
            $order->user_id = Yii::$app->user->id;
        }
            $session = Yii::$app->session;
            $session->remove('cart');
            $session->remove('cart.sum');
            $session->remove('cart.qty');
            $session->remove('cart.delivery');

        if($order->save(false)){
            Orders::deleteAll(['state' => NULL]);

            if($order->payment_id == 1){
                return $this->renderAjax('paycom', compact(['order']));
            } elseif ($order->payment_id == 2){
                return $this->renderAjax('click', compact(['order']));
            } else {
                return $this->render('thanks',['id' => $id]);
            }


        }
    }

    public function actionThanks($id){
        return $this->render('thanks',['id' => $id]);
    }

    //Insert Products from SESSION to table order_products
    protected function saveOrderItems ($items, $order_id) {         // Запись всех продуктов из Order
        foreach ($items as $id => $item) {
            $order_items = new OrderProducts();

            $order_items->orders_id = $order_id;
            $order_items->product_id = $item['id'];
            $order_items->quantity = $item['qty'];
            $order_items->discount = $item['price']*$item['qty'];
            $order_items->product_price = $item['price'];
            $order_items->color = $item['color'];
            $order_items->type = $item['type'];
            $order_items->save();
        }
    }


}