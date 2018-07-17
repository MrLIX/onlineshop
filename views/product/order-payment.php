<?php
/**
 * Created by PhpStorm.
 * User: SoS
 * Date: 25.06.2018
 * Time: 14:16
 */

use yii\helpers\Url;
use yii\widgets\ActiveForm;

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

                                <?php ActiveForm::begin([
                                        'action' => Url::to(['/product/order-result']),
                                        'method' => 'GET',
                                ]) ?>
                                <input name="order_id" value="<?= $order_id ?>" hidden>
                                    <div class="fmlz_pay_type">
                                        <ul class="fmlz_pay_type_ls us-n">
                                            <?php if(!empty($payments)): ?>
                                                <?php foreach ($payments as $k => $item):?>
                                                <li>
                                                    <div class="fmlz_pay_type_it <?= $k == 0 ? 'active' : ''?>">
                                                        <div class="fmlz_pay_type_rdo"></div>

                                                        <div class="fmlz_pay_type_img">
                                                            <img src="/uploads/<?= $item->path ?>" alt="">
                                                        </div>

                                                        <input type="radio" value="<?= $item->id ?>" class="inp" name="payment" hidden>
                                                    </div>
                                                </li>
                                                <?php endforeach;?>
                                            <?php endif; ?>

                                        </ul>
                                    </div>


                                    <div class="fmlz_btn_bx">
                                        <a href="<?= Url::to(['/product/order-address-return', 'order_id' => $order_id]) ?>" class="base_btn border_grey psnl_data_btn back"><?= Yii::t('app','Вернуться') ?></a>
                                        <button type="submit" class="base_btn solid_violet psnl_data_btn"><?= Yii::t('app','Продолжить') ?></button>
                                    </div>


                                    <div class="fmlz_pay_cond">
                                        <div class="fmlz_pay_cond_ttl text-uppercase"><?= Yii::t('app','Условия доставки') ?></div>

                                        <div class="fmlz_pay_cond_cnt">
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
                                <?php ActiveForm::end() ?>

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
