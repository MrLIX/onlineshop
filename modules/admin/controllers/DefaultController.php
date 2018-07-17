<?php

namespace app\modules\admin\controllers;

use app\models\forms\Signup;
use app\models\OrderProducts;
use app\models\Orders;
use app\models\Products;
use app\models\UserInfo;
use mdm\admin\models\form\Login;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $orders = Orders::find()->limit(10)->orderBy(['id' => SORT_DESC])->all();
        $sum = Orders::find()->sum('amount');
        $qty = OrderProducts::find()->sum('quantity');
        $products = Products::find()->count();
        $users = UserInfo::find()->count();

        return $this->render('index', compact([
            'sum',
            'qty',
            'products',
            'orders',
            'users',
        ]));
    }

    /**
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->getUser()->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'login';
        $model = new Login();

        if ($model->load(Yii::$app->getRequest()->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->getUser()->logout();

        return $this->goHome();
    }
}

