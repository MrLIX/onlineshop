<?php
/**
 * Created by PhpStorm.
 * User: SoS
 * Date: 21.06.2018
 * Time: 11:51
 */

use app\models\UserFavorites;
use yii\helpers\Url;

$this->title = 'DY Florist';
?>


<!-- |************************************************** Main **************************************************| -->
<main class="main bg_white">

    <!-- |=================================== Basket ===================================| -->
    <section class="basket_sec">
        <div class="container">

            <div class="basket">
                <h3 class="inr_title basket_ttl"><?= Yii::t('app', 'Корзина') ?></h3>

                <?php if (!empty($session)): ?>
                    <div class="basket_cnt">
                        <div class="basket_gr">
                            <form>
                                <div class="basket_gr_bd">
                                    <?php foreach ($session as $item): ?>
                                        <div class="basket_it" data-flower-close>
                                            <div class="basket_info">
                                                <div class="basket_img fx-c">
                                                    <img src="/uploads/<?= $item['img'] ?>" alt="">
                                                </div>

                                                <div class="basket_txt">
                                                    <div class="basket_name"><?= $item['name'] ?></div>

                                                    <ul class="basket_info_ls">
                                                        <li>
                                                            <span class="txt"><?= Yii::t('app', 'Цвет') ?>:</span>
                                                            <span class="val"><?= $item['color'] ?></span>
                                                        </li>

                                                        <li>
                                                            <span class="txt"><?= Yii::t('app', 'Тип') ?>:</span>
                                                            <span class="val"><?= $item['type'] ?></span>
                                                        </li>

                                                        <li>
                                                            <span class="txt"><?= Yii::t('app', 'Цена за штуку') ?>
                                                                :</span>
                                                            <span class="val"><?= number_format($item['price'] * 1, '0', '.', ' ') ?> <?= Yii::t('app', 'сум') ?></span>
                                                        </li>
                                                    </ul>

                                                    <div class="basket_chg">
                                                        <a href="<?= Url::to(['/product/change-prod', 'id' => $item['id'],'color' => $item['color'],'type' => $item['type']]) ?>"><?= Yii::t('app', 'Изменить') ?></a>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="basket_prc_bx">
                                                <div class="basket_amt">
                                                    <span class="basket_amt_txt"><?= Yii::t('app', 'Количество') ?>
                                                        :</span>

                                                    <div class="basket_amt_sel_bx">
                                                        <div class="basket_amt_sel">
                                                            <select class="ap-n change-prod-qty" name="count" data-url="<?= Url::to(['/product/change-prod-qty']) ?>" data-id="<?= $item['id'] ?>" data-type="<?= $item['type'] ?>" data-color="<?= $item['color'] ?>">

                                                                <?php $count = \app\models\Products::findOne($item['id']); ?>
                                                                 <?php $count = \yii\helpers\Json::decode($count->buy_count); ?>
                                                                    <?php foreach ($count as $c): ?>
                                                                        <option value="<?= $c ?>" <?= $c == $item['qty'] ? 'selected' : '' ?>><?= $c ?></option>
                                                                    <?php endforeach; ?>

                                                            </select>

                                                            <i class="fas fa-angle-down"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="basket_prc">
                                                    <span class="val"><?= number_format(($item['price'] * 1) * ($item['qty'] * 1), '0', '.', ' ') ?> </span>
                                                    <span class="txt"><?= Yii::t('app', 'сум') ?></span>
                                                </div>
                                            </div>


                                            <div class="flower_close fx-c basket_close del-from-cart"
                                                 data-url="<?= Url::to(['/product/del-from-cart']) ?>"
                                                 data-id="<?= $item['id'] ?>" data-color="<?= $item['color'] ?>"
                                                 data-type="<?= $item['type'] ?>">
                                                <i class="fas fa-times "></i>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>

                                </div>


                                <div class="basket_gr_ft">
                                    <div class="basket_cntu">
                                        <?php if (Yii::$app->user->isGuest): ?>
                                            <a href="#" class="base_btn border_pink basket_cntu_btn"
                                               data-login><?= Yii::t('app', 'Войти') ?></a>
                                        <?php else: ?>
                                            <a href="/"
                                               class="base_btn border_pink basket_cntu_btn"><?= Yii::t('app', 'продолжить покупки') ?></a>
                                        <?php endif; ?>
                                    </div>

                                    <div class="basket_cond">
                                        <div class="basket_cond_ttl text-uppercase">
                                            * <?= Yii::t('app', 'Условия доставки') ?></div>

                                        <div class="basket_cond_cnt">
                                            <?php if (!empty($delivery_price)): ?>

                                                <?php foreach ($delivery_price as $price): ?>

                                                    <?php if ($price->from == '0'): ?>
                                                        <p><?= Yii::t('app', 'При заказе до ') ?>
                                                            <strong><?= number_format($price->to, '0', '.', ' ') ?> <?= Yii::t('app', 'сум') ?></strong>
                                                            - <?= Yii::t('app', 'доставка') ?> <?= number_format($price->price, '0', '.', ' ') ?> <?= Yii::t('app', 'сум') ?>
                                                        </p>

                                                    <?php elseif ($price->to == '0'): ?>
                                                        <p><?= Yii::t('app', 'При заказе от ') ?>
                                                            <strong><?= number_format($price->from, '0', '.', ' ') ?> <?= Yii::t('app', 'сум') ?></strong>
                                                            - <?= Yii::t('app', 'доставка осуществляется') ?> <strong
                                                                    class="text-uppercase"><?= Yii::t('app', 'бесплатно') ?>
                                                                !</strong></p>

                                                    <?php else: ?>

                                                        <p><?= Yii::t('app', 'При заказе от ') ?>
                                                            <strong><?= number_format($price->from, '0', '.', ' ') ?> <?= Yii::t('app', 'сум') ?></strong> <?= Yii::t('app', 'до') ?>
                                                            <strong><?= number_format($price->to, '0', '.', ' ') ?> <?= Yii::t('app', 'сум') ?></strong>
                                                            - <?= number_format($price->price, '0', '.', ' ') ?> <?= Yii::t('app', 'сум') ?>
                                                        </p>

                                                    <?php endif; ?>

                                                <?php endforeach; ?>

                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="basket_fmlz">
                                        <div class="basket_fmlz_txt">
                                            <div class="basket_fmlz_it dlvr">
                                                <span class="txt"><?= Yii::t('app', 'Доставка') ?>:</span>
                                                <span class="val">
                                                <?php if (!empty($delivery_price)): ?>
                                                    <?php $qyt_price = $_SESSION['cart.sum']; ?>
                                                    <?php foreach ($delivery_price as $price): ?>
                                                        <?php if (($price->to == '0') && ($qyt_price > $price->from)): ?>
                                                            <?php $_SESSION['cart.delivery'] = $price->price; ?>
                                                            <strong class="text-uppercase"><?= Yii::t('app', 'бесплатно') ?>
                                                                !</strong>
                                                        <?php else: ?>
                                                            <?php if (($qyt_price >= $price->from) && ($qyt_price < $price->to)) {
                                                                $_SESSION['cart.delivery'] = $price->price;
                                                                echo number_format($price->price, '0', '.', ' ');
                                                            } ?>
                                                        <?php endif ?>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>

                                            </span>
                                            </div>

                                            <div class="basket_fmlz_it prc">
                                                <span class="txt"><?= Yii::t('app', 'Итого') ?>:</span>
                                                <span class="val"><?= number_format($_SESSION['cart.sum'], '0', '.', ' ') ?> <?= Yii::t('app', 'сум') ?></span>
                                            </div>
                                        </div>
                                        <?php if (Yii::$app->user->isGuest): ?>
                                            <a href="<?= Url::to(['/product/order-info']) ?>" class="base_btn solid_pink basket_fmlz_btn"><?= Yii::t('app', 'оформить как гость') ?></a>
                                        <?php else: ?>
                                            <a href="<?= Url::to(['/product/order-info']) ?>"  class="base_btn solid_pink basket_fmlz_btn"><?= Yii::t('app', 'оформить заказ') ?></a>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </form>
                        </div>


                        <div class="prod_rcmd">
                            <h2 class="base_title prod_rcmd_ttl"><?= Yii::t('app', 'Также у нас покупали') ?></h2>

                            <div class="prod_rcmd_cnt">
                                <div class="row flower_row">
                                    <?php if (!empty($most)): ?>
                                    <?php foreach ($most

                                    as $item): ?>
                                    <div class="col-lg-4 col-md-6 flower_col">
                                        <div class="flower">
                                            <div class="flower_img_bx">
                                                <a href="<?= Url::to(['/product/product', 'id' => $item->id]) ?>"
                                                   class="flower_img fx-c">
                                                    <img src="/uploads/<?= $item->path ?>" alt="">
                                                </a>


                                                <?php
                                                $fav_check = 0;
                                                if (Yii::$app->user->isGuest) { // Если Гость, проверяем из Сессии

                                                    if (!empty(Yii::$app->session['favorites'])) {
                                                        $favorite = Yii::$app->session['favorites'];
                                                        foreach ($favorite as $fav) {
                                                            if ($fav == $item->id) {
                                                                $fav_check = 1;
                                                            }
                                                        }
                                                    }

                                                } else {                       // Если не Гость, проверяем из таблицы user_favorites
                                                    $favorite = UserFavorites::find()->where(['user_id' => Yii::$app->user->id, 'product_id' => $item->id])->one();
                                                    if (!empty($favorite)) {
                                                        $fav_check = 1;
                                                    }
                                                }
                                                if ($fav_check == 1){ ?>
                                                <div class="flower_act like fx-c del-favorites active"
                                                     data-id="<?= $item->id ?>"
                                                     data-url="<?= Url::to(['/product/add-favorites']) ?>"
                                                     data-url-del="<?= Url::to(['/product/del-favorites']) ?>">

                                                    <?php } else{ ?>
                                                    <div class="flower_act like fx-c add-favorites"
                                                         data-id="<?= $item->id ?>"
                                                         data-url="<?= Url::to(['/product/add-favorites']) ?>"
                                                         data-url-del="<?= Url::to(['/product/del-favorites']) ?>">

                                                        <?php } ?>
                                                        <svg x="0px" y="0px" width="200px" height="200px"
                                                             viewBox="0 0 485 485"
                                                             style="enable-background:new 0 0 485 485;"
                                                             xml:space="preserve">
                                                <g>
                                                    <path
                                                            d="M343.611,22.543c-22.613,0-44.227,5.184-64.238,15.409c-13.622,6.959-26.136,16.205-36.873,27.175 c-10.738-10.97-23.251-20.216-36.873-27.175c-20.012-10.225-41.625-15.409-64.239-15.409C63.427,22.543,0,85.97,0,163.932 c0,55.219,29.163,113.866,86.678,174.314c48.022,50.471,106.816,92.543,147.681,118.95l8.141,5.261l8.141-5.261 c40.865-26.406,99.659-68.479,147.682-118.95C455.838,277.798,485,219.151,485,163.932C485,85.97,421.573,22.543,343.611,22.543z M376.589,317.566c-42.918,45.106-95.196,83.452-134.089,109.116c-38.893-25.665-91.171-64.01-134.088-109.116 C56.381,262.884,30,211.194,30,163.932c0-61.42,49.969-111.389,111.389-111.389c35.361,0,67.844,16.243,89.118,44.563 l11.993,15.965l11.993-15.965c21.274-28.32,53.757-44.563,89.118-44.563c61.42,0,111.389,49.969,111.389,111.389 C455,211.194,428.618,262.884,376.589,317.566z"/>
                                                </g>
                                            </svg>
                                                    </div>
                                                    <?php if (!empty($item->discount)): ?>
                                                        <div class="flower_per">-<?= $item->discount ?>%</div>
                                                    <?php endif; ?>
                                                </div>

                                                <div class="flower_txt">
                                                    <div class="flower_name"><?= $item->title ?></div>

                                                    <div class="flower_price">
                                                        <?php if (!empty($item->discount)): ?>
                                                            <div class="new"><?= number_format($item->discount_price, '0', '.', ' ') ?> <?= Yii::t('app', 'сум') ?></div>
                                                            <div class="old"><?= number_format($item->price, '0', '.', ' ') ?> <?= Yii::t('app', 'сум') ?></div>
                                                        <?php else: ?>
                                                            <div class="new"><?= number_format($item->price, '0', '.', ' ') ?> <?= Yii::t('app', 'сум') ?></div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <h3 style="padding: 10px; margin-bottom: 300px"><?= Yii::t('app', 'Ваша карзина пуста') ?></h3>
                <?php endif; ?>
            </div>

        </div>
        <!-- |========== Basket ==========| -->
    </section>

</main>
<!-- |********** Main **********| -->
