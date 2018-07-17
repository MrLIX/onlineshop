<?php
/**
 * Created by PhpStorm.
 * User: SoS
 * Date: 25.06.2018
 * Time: 14:58
 */

use yii\helpers\Url;

?>
<!-- |************************************************** Main **************************************************| -->
<main class="main bg_white">

    <!-- |=================================== Formalization ===================================| -->
    <section class="data_sec">
        <div class="container">

            <div class="data">
                <h3 class="inr_title data_ttl"><?= Yii::t('app','Оформление заказа') ?></h3>

                <div class="data_cnt">
                    <div class="data_tab">

                        <div class="data_tab_ttl">
                            <ul class="data_tab_ls us-n">
                                <li><?= Yii::t('app','Личные данные') ?></li>
                                <li><?= Yii::t('app','Адрес доставки') ?></li>
                                <li class="active"><?= Yii::t('app','Способ оплаты') ?></li>
                            </ul>
                        </div>


                        <div class="data_tab_cnt">
                            <div class="fmlz fmlz_pay">

                             <form action="<?= Url::to(['/product/order-finish']) ?>" method="get">
                                 <input name="order_id" value="<?= $order->id ?>" hidden>
                                    <div class="fmlz_pay_chosen">
                                        <div class="fmlz_pay_chosen_type">
                                            <div class="fmlz_pay_type_it active">
                                                <div class="fmlz_pay_type_rdo"></div>

                                                <div class="fmlz_pay_type_img">
                                                    <img src="/uploads/<?= !empty($order->payment->path) ? $order->payment->path : '' ?>" alt="">
                                                </div>

                                                <input type="radio" class="inp" hidden>
                                            </div>
                                        </div>


                                        <div class="fmlz_pay_chosen_txt">
                                            <?= Yii::t('app','Оплачивайте легко и удобно') ?>
                                        </div>
                                    </div>


                                    <div class="fmlz_pay_it_bx">
                                        <?php if(!empty($session)):?>
                                            <?php foreach ($session as $item): ?>
                                        <div class="basket_it fmlz_pay_it">
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

                                                </div>
                                            </div>


                                            <div class="basket_prc_bx">
                                                <div class="basket_amt">
                                                    <span class="basket_amt_txt"><?= Yii::t('app','Количество') ?>:</span>

                                                    <div class="basket_amt_sel_bx"><?= $item['qty'] ?></div>
                                                </div>

                                                <div class="basket_prc">
                                                    <span class="val"><?= number_format(($item['price'] * 1) * ($item['qty'] * 1), '0', '.', ' ') ?></span>
                                                    <span class="txt"><?= Yii::t('app', 'сум') ?></span>
                                                </div>
                                            </div>

                                        </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>


                                    <div class="basket_fmlz_txt fmlz_pay_total">
                                        <div class="basket_fmlz_it dlvr">
                                            <span class="txt"><?= Yii::t('app','Доставка') ?>:</span>
                                            <span class="val"><?= Yii::$app->session['cart.delivery'] ?> <?= Yii::t('app', 'сум') ?></span>
                                        </div>

                                        <div class="basket_fmlz_it prc">
                                            <span class="txt"><?= Yii::t('app','Итого') ?>: </span>
                                            <span class="val"><?= number_format(Yii::$app->session['cart.sum'] + Yii::$app->session['cart.delivery'], '0','.',' ') ?> <?= Yii::t('app', 'сум') ?></span>
                                        </div>
                                    </div>


                                    <div class="fmlz_btn_bx">
                                        <a href="<?= Url::to(['/product/order-payment-return', 'order_id' => $order_id]) ?>" class="base_btn border_grey psnl_data_btn back"><?= Yii::t('app','Вернуться') ?></a>
                                        <button type="submit" class="base_btn solid_violet psnl_data_btn"><?= Yii::t('app','Продолжить') ?></button>
                                    </div>

                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <!-- |========== Formalization ==========| -->
    </section>

</main>
<!-- |********** Main **********| -->
