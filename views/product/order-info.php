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
                            <?php if(Yii::$app->user->isGuest): ?>
                                <?php ActiveForm::begin([
                                    'action' => Url::to(['/product/order-get-sms']),
                                    'method' => 'GET',
                                    'id' => 'order-address'
                                ]) ?>
                                    <div class="psnl_data_fld">
                                        <div class="psnl_data_gr">
                                            <input type="text" id="name" name="name" class="psnl_data_inp"  placeholder="<?= Yii::t('app','* Ф.И.О.') ?>" data-code-active required>
                                        </div>

                                        <div class="psnl_data_gr">
                                            <input type="tel"  name="phone" id="phone" class="psnl_data_inp" placeholder="<?= Yii::t('app','* Телефон') ?>"  data-code-active required>
                                        </div>

                                        <div class="psnl_data_gr">
                                            <div class="fmlz_info_code">
                                                <div class="fmlz_info_code_fld">
                                                    <div class="fmlz_info_code_btn">
                                                        <a href="#" class="base_btn solid_pink psnl_data_btn order-get-code" data-code data-code-active><?= Yii::t('app','Получить код') ?></a>
                                                    </div>
                                                    <input type="hidden" name="sms" id="sms">

                                                    <div class="fmlz_info_code_inp">
                                                        <input type="text" id="code" class="psnl_data_inp sms-code" placeholder="<?= Yii::t('app','Введите код') ?>" data-code-disabled disabled="disabled" required`>
                                                    </div>
                                                </div>

                                                <div class="fmlz_info_code_txt">
                                                    <div class="fmlz_info_code_lbl"><?= Yii::t('app','Мы отправили Вам код через смс') ?></div>

                                                    <div class="fmlz_info_code_again">
                                                        <a href="#" class="bt"><?= Yii::t('app','Попробуйте снова') ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="psnl_data_btn_bx psnl_data_edit_btn">
                                            <button type="submit" class="base_btn solid_violet psnl_data_btn order-info-btn" disabled="disabled"><?= Yii::t('app','Продолжить') ?></button>
                                        </div>
                                    </div>
                                <?php ActiveForm::end(); ?>
                                <?php else: ?>
                                <div class="psnl_data_fld">
                                <?php ActiveForm::begin([
                                    'action' => Url::to(['/product/order-address']),
                                    'method' => 'GET',

                                ]) ?>

                                    <div class="psnl_data_gr">
                                        <input type="text" name="name" value="<?= !empty($user_info->name) ? $user_info->name : '' ?>" class="psnl_data_inp" placeholder="<?= Yii::t('app','* Ф.И.О.') ?>" required>
                                    </div>

                                    <div class="psnl_data_gr">
                                        <input type="tel" name="phone" value="<?= !empty($user_info->phone) ? $user_info->phone : '' ?>" class="psnl_data_inp" placeholder="<?= Yii::t('app','* Телефон') ?>" required>
                                    </div>


                                    <div class="psnl_data_btn_bx psnl_data_edit_btn">
                                        <button type="submit" class="base_btn solid_violet"><?= Yii::t('app','Продолжить')?></button>
                                    </div>
                              <?php ActiveForm::end(); ?>
                                </div>
                                <?php endif; ?>

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


