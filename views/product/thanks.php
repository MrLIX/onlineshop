<?php
/**
 * Created by PhpStorm.
 * User: SoS
 * Date: 25.06.2018
 * Time: 15:47
 */
?>
<!-- |************************************************** Main **************************************************| -->
<main class="main bg_white">

    <!-- |=================================== Thanks ===================================| -->
    <section class="thanks_sec">
        <div class="container">
            <div class="thanks">
                <h3 class="inr_title thanks_ttl"><?= Yii::t('app','Оформление заказа') ?></h3>


                <div class="thanks_cnt">
                    <div class="thanks_check fx-c">
                        <i class="fas fa-check"></i>
                    </div>


                    <div class="thanks_txt">
                        <div class="thanks_tx"><?= Yii::t('app','Спасибо') ?>!</div>

                        <div class="thanks_accept"><?= Yii::t('app','Ваш заказ принят') ?></div>

                        <div class="thanks_info">
                            <p><?= Yii::t('app','Номер вашего заказа') ?> <span class="num">№ 000<?= $id ?></span></p>
                            <p><?= Yii::t('app','В ближайшее время с вами свяжутся наши сотрудники') ?></p>
                        </div>
                    </div>


                    <div class="thanks_back">
                        <a href="/" class="base_btn border_grey psnl_data_btn"><?= Yii::t('app','на главную') ?></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- |========== Thanks ==========| -->
    </section>

</main>
<!-- |********** Main **********| -->
