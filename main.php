<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\models\Category;
use app\models\Contacts;
use app\models\forms\Login;
use app\models\Partners;
use app\models\Phones;
use app\models\Socials;
use app\models\SubCategory;
use app\models\UserFavorites;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);

$social = Socials::find()->where(['status' => 1])->all();
$partners = Partners::find()->where(['status' => 1])->all();
$contact = Contacts::find()->one();

$menu1 = Category::find()->where(['id' => 1])->one();
$submenu1 = SubCategory::find()->where(['category_id' => $menu1->id])->all();
$menu2 = Category::find()->where(['id' => 2])->one();
$submenu2 = SubCategory::find()->where(['category_id' => $menu2->id])->all();
$menu3 = SubCategory::find()->where(['id' => 10])->one();
$menu4 = SubCategory::find()->where(['id' => 11])->one();
$phones = Phones::find()->all();
$favorites = Yii::$app->session['favorites'];
$cart = Yii::$app->session['cart'];

$model = new Login();

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.png">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?php $this->head() ?>
</head>
<body>
<!-- |____________________ Internet Explorer ____________________| -->
<!--[if IE]>
<div class="ie_bx">
    <h2>You are using the old version of Internet Explorer</h2>
    <h2>Please, download Google Chrome for better performance!</h2>
    <h2><a href="https://www.google.com/chrome/">https://www.google.com/chrome/</a></h2>
</div>

<div class="ie_bg"></div>
<![endif]-->
<!-- |__________ Internet Explorer __________| -->
<?php $this->beginBody() ?>

<header class="header">
    <div class="container">

        <!-- |=================================== Header Top ===================================| -->
        <div class="hdr_top">
            <div class="hdr_scl">
                <ul class="hdr_scl_ls">
                    <?php if(!empty($social)): ?>
                    <?php foreach ($social as $item): ?>
                        <li>
                        <a href="<?= $item->url ?>">
                          <?= $item->path?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                    <?php endif; ?>


                </ul>

                <div class="hdr_cont">
                    <a href="<?= Url::to(['site/contact']) ?>" title="Контакты">
                        <svg x="0px" y="0px" width="200px" height="200px" viewBox="0 0 512.001 512.001"
                             style="enable-background:new 0 0 512.001 512.001;" xml:space="preserve">
							<g>
                                <path
                                        d="M487.073,66.843L419.999,0L280.703,139.065l54.001,55.77c-9.05,16.066-28.686,46.841-62.151,80.305 c-33.469,33.47-64.469,53.33-80.688,62.524l-54.676-53.979L0.068,419.99l66.708,67.152c25.499,25.499,64.298,32.107,96.546,16.445 c49.21-23.9,123.477-68,197.838-142.361c74.359-74.359,118.458-148.627,142.36-197.837c5.663-11.66,8.414-24.175,8.414-36.609 C511.934,104.824,503.353,83.122,487.073,66.843z M467.567,145.925c-22.562,46.453-64.24,116.609-134.67,187.039 c-70.432,70.433-140.587,112.109-187.038,134.67c-16.935,8.225-37.36,4.707-50.775-8.708l-38.502-38.759l80.706-80.221 l46.579,45.984l12.462-5.55c2.025-0.902,50.223-22.711,104.489-76.977c54.302-54.302,75.658-102.092,76.54-104.101l5.404-12.295 l-45.962-47.467l83.227-83.09l38.804,38.669C472.276,108.584,475.789,128.999,467.567,145.925z"/>
                            </g>
						</svg>
                    </a>
                </div>
            </div>


            <div class="hdr_lang">
                <ul class="hdr_lang_ls">
                    <li><a href="<?= Url::to(['/site/set-language', 'lang' => 'ru']) ?>" class="flag"><img src="/img/flag_ru.png" alt=""></a></li>
                    <li><a href="<?= Url::to(['/site/set-language', 'lang' => 'en']) ?>" class="flag"><img src="/img/flag_en.png" alt=""></a></li>
                </ul>
            </div>
            <!-- |========== Header Top ==========| -->
        </div>


        <!-- |=================================== Header Bottom ===================================| -->
        <div class="hdr_btm">
            <div class="nav_menu_bx">

                <!-- |____________________ Navigation Menu ____________________| -->
                <div class="nav_menu">
                    <ul class="nav_menu_ls">
                        <li class="<?= Yii::$app->controller->id == 'about' ? 'active' : '' ?>"><a href="<?= Url::to(['/site/about']) ?>"><?= Yii::t('app','О нас') ?></a></li>
                        <li class="<?= Yii::$app->controller->id == 'our-services' ? 'active' : '' ?>"><a href="<?= Url::to(['/site/our-services']) ?>"><?= Yii::t('app','Наши услуги') ?></a></li>

                        <li>
                            <a><?= Yii::t('app','Продукция') ?></a>

                            <ul class="nav_menu_drop_1">
                                <li>
                                    <a href="<?= Url::to(['product/category', 'id' => $menu1->id]) ?>"><?= $menu1->title ?></a>
                                    <ul class="nav_menu_drop_2">
                                        <?php if(!empty($submenu1)): ?>
                                            <?php foreach ($submenu1 as $item): ?>
                                                <li><a href="<?= Url::to(['/product/sub-category', 'id' => $item->id]) ?>"><?= $item->title ?></a></li>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                                <li>
                                    <a href="<?= Url::to(['product/category', 'id' => $menu2->id]) ?>"><?= $menu2->title ?></a>
                                    <ul class="nav_menu_drop_2">
                                        <?php if(!empty($submenu2)): ?>
                                            <?php foreach ($submenu2 as $item): ?>
                                                <li><a href="<?= Url::to(['/product/sub-category', 'id' => $item->id]) ?>"><?= $item->title ?></a></li>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                                <li><a href="<?= Url::to(['/product/sub-category', 'id' => $menu3->id ]) ?>"><?= $menu3->title ?></a></li>
                                <li><a href="<?= Url::to(['/product/sub-category', 'id' => $menu4->id ]) ?>"><?= $menu4->title ?></a></li>

                            </ul>
                        </li>
                    </ul>
                    <!-- |__________ Navigation Menu __________| -->
                </div>


                <!-- |____________________ Navigation Mobile Button ____________________| -->
                <button type="button" class="nav_menu_btn fx-c">
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                </button>


                <!-- |____________________ Navigation Mobile Background ____________________| -->
                <div class="nav_menu_bg"></div>
            </div>


            <div class="logo_bx">
                <div class="logo">
                    <a href="/">
                        <img src="/img/logo.png" alt="logo">
                    </a>
                </div>
            </div>


            <div class="hdr_act">
                <ul class="hdr_act_ls">
                    <li class="hdr_act_number">
                        <a href="<?= Url::to(['/product/favorites']) ?>" class="bt">
                            <svg x="0px" y="0px" width="200px" height="200px" viewBox="0 0 485 485"
                                 style="enable-background:new 0 0 485 485;" xml:space="preserve">
								<g>
                                    <path
                                            d="M343.611,22.543c-22.613,0-44.227,5.184-64.238,15.409c-13.622,6.959-26.136,16.205-36.873,27.175 c-10.738-10.97-23.251-20.216-36.873-27.175c-20.012-10.225-41.625-15.409-64.239-15.409C63.427,22.543,0,85.97,0,163.932 c0,55.219,29.163,113.866,86.678,174.314c48.022,50.471,106.816,92.543,147.681,118.95l8.141,5.261l8.141-5.261 c40.865-26.406,99.659-68.479,147.682-118.95C455.838,277.798,485,219.151,485,163.932C485,85.97,421.573,22.543,343.611,22.543z M376.589,317.566c-42.918,45.106-95.196,83.452-134.089,109.116c-38.893-25.665-91.171-64.01-134.088-109.116 C56.381,262.884,30,211.194,30,163.932c0-61.42,49.969-111.389,111.389-111.389c35.361,0,67.844,16.243,89.118,44.563 l11.993,15.965l11.993-15.965c21.274-28.32,53.757-44.563,89.118-44.563c61.42,0,111.389,49.969,111.389,111.389 C455,211.194,428.618,262.884,376.589,317.566z"/>
                                </g>
							</svg>
                            <span class="num count-favorites" style="display: block; color: #fff;">
                            <?php if(Yii::$app->user->isGuest): ?>
                                <?php if(!empty($favorites)): ?>
                                        <?= count($favorites) ?>
                                <?php endif; ?>
                            <?php else: ?>
                                <?php $favorites = UserFavorites::find()->where(['user_id' => Yii::$app->user->id])->count();?>
                                        <?= $favorites ?>
                            <?php endif; ?>
                            </span>
                        </a>
                    </li>

                    <li class="hdr_act_number">
                        <a href="<?= Url::to(['/product/cart'])?>" class="bt">
                            <svg x="0px" y="0px" width="200px" height="200px" viewBox="0 0 512 512"
                                 style="enable-background:new 0 0 512 512;" xml:space="preserve">
								<g>
                                    <path
                                            d="M418.783,334.787c15.559-11.689,26.828-27.669,32.601-46.23L512,109.102H122.337l-4.299-47.67 c-1.479-16.766-9.13-32.261-21.543-43.627C84.081,6.439,67.975,0.178,51.143,0.178H0v39.972h51.143 c14.189,0,25.83,10.659,27.08,24.834l31.281,346.847c0.005,0.062,0.011,0.123,0.017,0.185 c3.049,30.622,26.04,54.542,55.415,59.526c7.833,23.379,29.927,40.279,55.909,40.279c25.497,0,47.26-16.272,55.465-38.973h46.959 c8.205,22.701,29.968,38.973,55.465,38.973c32.51,0,58.959-26.45,58.959-58.959c0-32.509-26.449-58.959-58.959-58.959 c-25.497,0-47.26,16.272-55.465,38.973h-46.959c-8.205-22.701-29.968-38.973-55.465-38.973c-24.644,0-45.792,15.203-54.59,36.718 c-9.159-3.636-15.886-12.105-16.95-22.484l-4.979-55.206h220.418C384.294,352.932,402.98,346.658,418.783,334.787z M378.736,433.876c10.47,0,18.987,8.517,18.987,18.987s-8.517,18.987-18.987,18.987c-10.47,0-18.987-8.517-18.987-18.987 S368.266,433.876,378.736,433.876z M220.846,433.876c10.47,0,18.987,8.517,18.987,18.987s-8.517,18.987-18.987,18.987 s-18.987-8.517-18.987-18.987S210.376,433.876,220.846,433.876z M140.722,312.961v-0 001l-14.781-163.886h330.366l-42.875,126.932 l-0.167,0.519c-6.6,21.453-26.552,36.436-48.519,36.436H140.722z"/>
                                </g>
							</svg>

                            <span class="num count_cart" style="display: block; color: #fff;"><?= !empty($cart) ? count($cart) : '' ?></span>
                        </a>
                    </li>

                    <li class="hdr_act_user">
                        <a href="" class="bt" data-login>
                            <svg x="0px" y="0px" width="200px" height="200px" viewBox="0 0 512 512"
                                 style="enable-background:new 0 0 512 512;" xml:space="preserve">
								<g>
                                    <path
                                            d="M437.02,330.98c-27.883-27.882-61.071-48.523-97.281-61.018C378.521,243.251,404,198.548,404,148 C404,66.393,337.607,0,256,0S108,66.393,108,148c0,50.548,25.479,95.251,64.262,121.962 c-36.21,12.495-69.398,33.136-97.281,61.018C26.629,379.333,0,443.62,0,512h40c0-119.103,96.897-216,216-216s216,96.897,216,216 h40C512,443.62,485.371,379.333,437.02,330.98z M256,256c-59.551,0-108-48.448-108-108S196.449,40,256,40 c59.551,0,108,48.448,108,108S315.551,256,256,256z"/>
                                </g>
							</svg>
                        </a>
                        <?php if(Yii::$app->user->isGuest): ?>
                        <div class="reg_pop">
                            <div class="reg_pop_ttl"><?= Yii::t('app','Авторизация') ?></div>

                            <div class="reg_pop_cnt">
                                <?php $form = ActiveForm::begin([
                                    'id' => 'login-form',
                                    'action' => Url::to(['site/login'])
                                ]); ?>

                                    <div class="reg_pop_it">
                                        <p class="reg_pop_lbl"><?= Yii::t('app','Логин') ?></p>
                                        <?= $form->field($model, 'username', ['template' => '{input}{error}', 'options' => ['tag' => false]])->textInput(['placeholder' => Yii::t('app','Логин'),'class' => 'reg_pop_inp'])->label(false) ?>

<!--                                        <input type="text" name="username" class="reg_pop_inp" placeholder="--><?//= Yii::t('app','Логин') ?><!--">-->
                                    </div>

                                    <div class="reg_pop_it">
                                        <p class="reg_pop_lbl s_btw">
                                            <span><?= Yii::t('app','Пароль') ?></span>

                                            <a href="" data-toggle="modal" data-target="#PassRecovery"><?= Yii::t('app','Забыли пароль?') ?></a>
                                        </p>
                                        <?= $form->field($model, 'password', ['template' => '{input}{error}', 'options' => ['tag' => false]])->textInput(['type'=>'password','placeholder' => Yii::t('app','Логин'),'class' => 'reg_pop_inp'])->label(false) ?>

<!--                                        <input type="password" name="password" class="reg_pop_inp" placeholder="--><?//= Yii::t('app','Пароль') ?><!--">-->
                                    </div>

                                    <div class="reg_pop_it">
                                        <div class="reg_pop_chk_bx">
                                            <div class="reg_pop_chk"><?= Yii::t('app','Запомнить меня') ?></div>

                                            <input type="checkbox" class="reg_pop_chk_inp" hidden>
                                        </div>
                                    </div>

                                    <div class="reg_pop_it">
                                        <button type="submit" class="base_btn border_white reg_pop_btn login"><?= Yii::t('app','Вход') ?>
                                        </button>
                                    </div>

                                    <div class="reg_pop_it">
                                        <a href="" class="base_btn border_white reg_pop_btn register"
                                           data-toggle="modal" data-target="#RegModal_1"><?= Yii::t('app','Регистрация') ?></a>
                                    </div>

                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>

                        <?php else: ?>

                        <div class="reg_pop_auth">
                            <ul class="reg_pop_auth_ls">
                                <li><a href="<?= Url::to(['/site/cabinet']) ?>"><?= Yii::t('app','Личный кабинет') ?></a></li>
                                <li><a href="<?= Url::to(['/site/logout'])  ?>" data-method="post"><?= Yii::t('app','Выйти') ?></a></li>
                            </ul>
                        </div>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
            <!-- |========== Header Bottom ==========| -->
        </div>

    </div>
    <!-- |********** Header **********| -->
</header>


<?= $content ?>


<!-- |************************************************** Footer **************************************************| -->
<footer class="footer">
    <div class="footer_bg bg-cover" style="background-image:url('/img/home/section_bg_3.png');"></div>


    <!-- |=================================== Partners ===================================| -->
    <section class="partner_sec">
        <div class="container">

            <div class="partner">
                <h2 class="base_title"><?= Yii::t('app','Наши партнеры') ?></h2>
                <div class="partner_cnt">
                    <div class="partner_bnr">
                        <?php foreach ($partners as $item): ?>
                        <div class="partner_bnr_it">
                            <img class="lazyOwl" data-src="/uploads/<?= $item->path ?>" src="">
                        </div>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>

        </div>
        <!-- |========== Partners ==========| -->
    </section>


    <!-- |=================================== Dealer ===================================| -->
    <section class="dealer_sec">
        <div class="container">

            <div class="dealer">
                <div class="dealer_it dealer_txt"><?= Yii::t('app','Официальный диллер') ?>:</div>

                <div class="dealer_it dealer_img">
                    <img src="/img/home/dealer.png" alt="">
                </div>

                <div class="dealer_it dealer_site">
                    <a href="http://www.floristholland.com">www.floristholland.com</a>
                </div>
            </div>

        </div>
        <!-- |========== Dealer ==========| -->
    </section>


    <!-- |=================================== Information ===================================| -->
    <section class="ft_info_sec">
        <div class="container">

            <div class="ft_info">

                <div class="ft_info_it">
                    <div class="ft_info_app">
                        <a href="" class="base_btn border_white"><?= Yii::t('app','оставить заявку') ?></a>
                    </div>
                </div>

                <div class="ft_info_it">
                    <ul class="ft_info_menu">
                        <li><a href="<?= Url::to(['/site/about']) ?>"><?= Yii::t('app','О нас') ?></a></li>
                        <li><a href="<?= Url::to(['/site/our-services']) ?>"><?= Yii::t('app','Наши услуги') ?></a></li>
                        <li><a href="<?= Url::to(['/site/delivery']) ?>"><?= Yii::t('app','Доставка') ?></a></li>
                        <li><a href="<?= Url::to(['/site/contact']) ?>"><?= Yii::t('app','Контакты') ?></a></li>
                    </ul>
                </div>

                <div class="ft_info_it">
                    <div class="ft_info_cont_bx">
                        <div class="ft_info_cont">
<!--                            <div class="ft_info_cont_ttl">-->
<!--                                <a>--><?//= Yii::t('app','Контакты')?><!--</a>-->
<!--                            </div>-->
                        <?php if(!empty($contact)): ?>
                            <ul class="ft_info_cont_ls">
                                <li>
                                    <div class="ft_info_cont_it">
                                        <i class="fas fa-home"></i>
                                        <div class="txt"><?= $contact->main_email?></div>
                                    </div>
                                </li>

                                <li>
                                    <div class="ft_info_cont_it">
                                        <i class="fas fa-envelope"></i>
                                        <div class="txt"><?= $contact->emial ?></div>
                                    </div>
                                </li>

                                <li>
                                    <div class="ft_info_cont_it" style="max-width: 300px">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <div class="txt"><?= $contact->address?></div>
                                    </div>
                                </li>
                            </ul>
                        <?php endif; ?>
                        </div>


                        <div class="ft_info_cont_tel_bx">
                            <div class="ft_info_cont_it">
                                <i class="fas fa-phone-square"></i>

                                <div class="txt">
                                    <?php if(!empty($phones)): ?>
                                    <?php foreach ($phones as $item): ?>
                                    <ul class="ft_info_cont_tel">
                                        <li><?= $item->phone ?></li>
                                        <?php if($item->lang_uz == 1): ?>
                                            <li>
                                                <img src="/img/flag_uz.png" alt="">
                                            </li>
                                        <?php endif; ?>
                                        <?php if($item->lang_ru == 1): ?>
                                            <li>
                                                <img src="/img/flag_ru.png" alt="">
                                            </li>
                                        <?php endif; ?>
                                        <?php if($item->lang_en == 1): ?>
                                            <li>
                                                <img src="/img/flag_en.png" alt="">
                                            </li>
                                        <?php endif; ?>

                                    </ul>

                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!-- |========== Information ==========| -->
    </section>


    <!-- |=================================== Copyright ===================================| -->
    <section class="ft_copy_sec">
        <div class="container">

            <div class="ft_copy">

                <div class="ft_copy_it">
                    <div class="ft_copy_txt">&copy; 2018 DY FLORIST. <?= Yii::t('app','Все права защищены.')?></div>
                </div>

                <div class="ft_copy_it">
                    <ul class="hdr_scl_ls ft_copy_scl">
                        <?php if(!empty($social)): ?>
                            <?php foreach ($social as $item): ?>
                                <li>
                                    <a href="<?= $item->url ?>">
                                        <?= $item->path?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </ul>
                </div>

                <div class="ft_copy_it">
                    <div class="ft_copy_maker">
                        <span class="make"><?= Yii::t('app','Разработка сайта -') ?> </span>

                        <a href="http://sos.uz">
                            <svg width="893" height="1024" viewBox="0 0 893 1024">
                                <path d="M277.005 599.959v-187.733l170.667-102.4 165.415 103.713v182.482l-165.415 107.651-170.667-103.713zM703.672 645.908v-280.944l-256-161.477-262.564 158.851v288.821l262.564 160.164 256-165.415z"></path>
                                <path d="M277.005 599.959v-186.421l170.667-102.4 1.313 1.313v-107.651l-1.313-1.313-262.564 158.851v288.821l262.564 158.851 1.313-1.313v-105.026l-1.313 1.313z"></path>
                                <path d="M443.733 884.841v131.282l144.41-87.959v-131.282l-144.41 87.959zM298.010 796.882v131.282l144.41 87.959v-131.282l-144.41-87.959z"></path>
                                <path d="M443.733 884.841l-145.723-87.959v131.282l145.723 87.959z"></path>
                                <path d="M443.733 131.282v-131.282l144.41 87.959v131.282l-144.41-87.959zM298.010 219.241v-131.282l144.41-87.959v131.282l-144.41 87.959z"></path>
                                <path d="M443.733 131.282l-145.723 87.959v-131.282l145.723-87.959z"></path>
                                <path d="M771.938 682.667l115.528 63.015-6.564-169.354-115.528-63.015 6.564 169.354zM624.903 766.687l115.528 63.015 147.036-84.021-115.528-63.015-147.036 84.021z"></path>
                                <path d="M771.938 682.667l-147.036 84.021 115.528 63.015 147.036-84.021z"></path>
                                <path d="M116.841 324.267l-114.215-63.015 148.349-82.708 114.215 64.328-148.349 81.395zM123.405 493.621l-114.215-63.015-6.564-169.354 114.215 63.015 6.564 169.354z"></path>
                                <path d="M116.841 324.267l6.564 169.354-114.215-64.328-6.564-169.354z"></path>
                                <path d="M115.528 690.544l-112.903 65.641 2.626-169.354 112.903-66.954-2.626 170.667zM265.19 770.626l-112.903 65.641-149.662-80.082 112.903-65.641 149.662 80.082z"></path>
                                <path d="M115.528 690.544l149.662 80.082-112.903 65.641-149.662-80.082z"></path>
                                <path d="M771.938 328.205l115.528-61.703-145.723-85.333-115.528 61.703 145.723 85.333zM761.436 497.559l115.528-61.703 10.503-169.354-115.528 61.703-10.503 169.354z"></path>
                                <path d="M771.938 328.205l-10.503 169.354 116.841-61.703 9.19-169.354z"></path>
                            </svg>

                            <span class="txt">SOS</span>
                        </a>
                    </div>
                </div>

            </div>

        </div>
        <!-- |========== Copyright ==========| -->
    </section>
    <div class="loader hidden"><img src="/images/2.gif"/></div>
</footer>
<!-- |********** Footer **********| -->


<!-- |=================================== Registration Modal 1 ===================================| -->
<div class="modal fade base_modal model-reg" id="RegModal_1">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="base_modal_close" data-dismiss="modal">
                <i class="fas fa-times"></i>
            </button>

            <div class="modal-body">
                <?php ActiveForm::begin(['id' => 'sign-up', 'action' => Url::to(['site/sign-up']), 'method' => 'post']); ?>

                    <div class="base_modal_hd"><?= Yii::t('app','Регистрация на DY Florist') ?></div>


                    <div class="base_modal_bd">
                        <div class="base_modal_fld">

                            <div class="psnl_data_gr">
                                <?= Html::input('text', 'username', '',['class'=> 'reg_pop_inp base_modal_inp', 'required' => true, 'placeholder' => Yii::t('app','* Логин') ]) ?>
                            </div>

                            <div class="psnl_data_gr">
                                <?= Html::input('password', 'password', '',['id' => 'password', 'class'=> 'reg_pop_inp base_modal_inp','required' => true, 'minlength' => '6','placeholder' => Yii::t('app','* Пароль')]) ?>
                            </div>

                            <div class="psnl_data_gr">
                                <?= Html::input('password', 'confirm_password', '',['id' => 'confirm_password', 'onkeyup' => 'validatePassword()', 'class'=> 'reg_pop_inp base_modal_inp','required' => true, 'minlength' => '6','placeholder' => Yii::t('app','* Повторит пароль')]) ?>
                            </div>

                        </div>
                    </div>


                    <div class="base_modal_ft">
                        <button type="submit" class="base_btn solid_violet"><?= Yii::t('app','Зарегистрироваться') ?>
                        </button>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
<!-- |========== Registration Modal 1 ==========| -->





<!-- |=================================== Password Recovery Modal ===================================| -->
<div class="modal fade base_modal" id="PassRecovery">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="base_modal_close" data-dismiss="modal">
                <i class="fas fa-times"></i>
            </button>

            <div class="modal-body">
                <form>
                    <div class="base_modal_hd">восстановить пароль</div>


                    <div class="base_modal_bd">
                        <div class="base_modal_fld">

                            <div class="psnl_data_gr">
                                <input type="tel" class="reg_pop_inp base_modal_inp" placeholder="* Номер телефона"
                                       data-code-active>

                                <p class="base_modal_lbl">Введите номер указанный при регистрации</p>
                            </div>


                            <div class="psnl_data_gr">
                                <div class="fmlz_info_code base_modal_code">
                                    <div class="fmlz_info_code_fld">
                                        <div class="fmlz_info_code_btn">
                                            <button type="submit" class="base_btn solid_violet psnl_data_btn" data-code
                                                    data-code-active>Получить код
                                            </button>
                                        </div>

                                        <div class="fmlz_info_code_inp">
                                            <input type="text" class="reg_pop_inp base_modal_inp"
                                                   placeholder="Введите код" data-code-disabled disabled="disabled">
                                        </div>
                                    </div>

                                    <div class="fmlz_info_code_txt">
                                        <div class="fmlz_info_code_lbl">Мы отправили Вам код через смс</div>

                                        <div class="fmlz_info_code_again">
                                            <a href="" class="bt">Попробуйте снова</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="base_modal_ft">
                        <button type="submit" class="base_btn solid_violet psnl_data_btn base_modal_btn"
                                data-dismiss="modal">Отправить
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- |========== Password Recovery Modal ==========| -->


<!-- |=================================== Password New Modal ===================================| -->
<div class="modal fade base_modal" id="PassNew">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="base_modal_close" data-dismiss="modal">
                <i class="fas fa-times"></i>
            </button>

            <div class="modal-body">
                <form>
                    <div class="base_modal_hd">Установить пароль</div>


                    <div class="base_modal_bd">
                        <div class="base_modal_fld">

                            <div class="psnl_data_gr">
                                <input type="password" class="reg_pop_inp base_modal_inp" placeholder="* Новый пароль">
                            </div>

                            <div class="psnl_data_gr">
                                <input type="password" class="reg_pop_inp base_modal_inp"
                                       placeholder="* Подтвердить пароль">
                            </div>

                        </div>
                    </div>


                    <div class="base_modal_ft">
                        <button type="submit" class="base_btn solid_violet psnl_data_btn base_modal_btn">Установить
                            пароль
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- |========== Password New Modal ==========| -->


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
