<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Delivery';
?>
<!-- |************************************************** Main **************************************************| -->
<main class="main">

    <!-- |=================================== Inner Banner ===================================| -->
    <section class="inner_bnr_sec">
        <div class="inner_bnr_bg bg-cover" style="background-image:url('/uploads/<?= $about->path ?>');     height: 400px;"></div>
        <!-- |========== Inner Banner ==========| -->
    </section>



    <!-- |=================================== About Us ===================================| -->
    <section class="abt_us_sec">
        <div class="product_bg bg-cover" style="background-image:url('/img/about_us/section_bg.png');"></div>

        <div class="container">
            <div class="abt_us">

                <div class="abt_us_desc">
                    <h3 class="inr_title abt_us_desc_ttl"><?= $about->title ?></h3>

                    <div class="abt_us_desc_cnt">
                        <?= $about->content ?>
                    </div>
                </div>


                <div class="abt_us_work">
                    <h2 class="base_title abt_us_work_ttl"><?= Yii::t('app','Для кого мы работаем?') ?></h2>

                    <div class="abt_us_work_cnt">
                        <div class="row">
                            <div class="col-4 abt_us_work_it">
                                <div class="abt_us_work_img fx-c">
                                    <img src="/img/about_us/about_us_1.png" alt="">
                                </div>

                                <div class="abt_us_work_name"><?= $about->param1Title ?></div>

                                <div class="abt_us_work_txt"><?= $about->param1Content ?>
                                </div>
                            </div>

                            <div class="col-4 abt_us_work_it">
                                <div class="abt_us_work_img fx-c">
                                    <img src="/img/about_us/about_us_2.png" alt="">
                                </div>

                                <div class="abt_us_work_name"><?= $about->param2Title ?></div>

                                <div class="abt_us_work_txt"><?= $about->param2Content ?>
                                </div>
                            </div>

                            <div class="col-4 abt_us_work_it">
                                <div class="abt_us_work_img fx-c">
                                    <img src="/img/about_us/about_us_3.png" alt="">
                                </div>

                                <div class="abt_us_work_name"><?= $about->param3Title ?></div>

                                <div class="abt_us_work_txt"><?= $about->param3Content ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- |========== About Us ==========| -->
    </section>

</main>
<!-- |********** Main **********| -->