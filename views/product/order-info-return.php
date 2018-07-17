<?php
/**
 * Created by PhpStorm.
 * User: SoS
 * Date: 25.06.2018
 * Time: 10:34
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
                                <li class="active"><?= Yii::t('app','Личные данные') ?></li>
                                <li><?= Yii::t('app','Адрес доставки') ?></li>
                                <li><?= Yii::t('app','Способ оплаты') ?></li>
                            </ul>
                        </div>


                        <div class="data_tab_cnt">
                            <div class="fmlz fmlz_info">

                                    <div class="psnl_data_fld">
                                        <?php ActiveForm::begin([
                                            'action' => Url::to(['/product/order-info-return']),
                                            'method' => 'GET',

                                        ]) ?>
                                        <input name="order_id" value="<?= $order->id ?>" hidden>
                                        <div class="psnl_data_gr">
                                            <input type="text" name="name" value="<?= !empty($order->name) ? $order->name : '' ?>" class="psnl_data_inp" placeholder="<?= Yii::t('app','* Ф.И.О.') ?>" required>
                                        </div>

                                        <div class="psnl_data_gr">
                                            <input type="tel" name="phone" value="<?= !empty($order->phone) ? $order->phone : '' ?>" class="psnl_data_inp" placeholder="<?= Yii::t('app','* Телефон') ?>" required>
                                        </div>


                                        <div class="psnl_data_btn_bx psnl_data_edit_btn">
                                            <button type="submit" class="base_btn solid_violet"><?= Yii::t('app','Продолжить')?></button>
                                        </div>
                                        <?php ActiveForm::end(); ?>
                                    </div>


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


