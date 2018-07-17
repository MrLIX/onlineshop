<?php
/**
 * Created by PhpStorm.
 * User: SoS
 * Date: 19.06.2018
 * Time: 13:41
 */

$this->title = 'Our Services';
?>

<main class="main">

    <!-- |=================================== Inner Banner ===================================| -->
    <section class="inner_bnr_sec">
        <div class="inner_bnr_bg bg-cover" style="background-image:url('/uploads/<?= $our_service->path ?>'); height: 400px"></div>
        <!-- |========== Inner Banner ==========| -->
    </section>



    <!-- |=================================== Service ===================================| -->
    <section class="svc_sec">
        <div class="container">

            <div class="svc">
                <div class="svc_ttl">

                    <h3 class="inr_title svc_ttl_name"><?= $our_service->title ?></h3>

                    <div class="svc_ttl_capt"><?= Yii::t('app','Главная / Наши услуги') ?></div>

                    <div class="svc_ttl_txt">
                        <?= $our_service->content ?>
                    </div>
                </div>


                <div class="svc_cnt">
                    <?php if($our_services): ?>
                    <?php foreach($our_services as $k => $item): ?>
                    <div class="svc_it <?= $k%2 == 0 ? ' ' : 'reverse' ?> ">
                        <div class="row">

                            <div class="svc_it_col col-lg-6">
                                <div class="svc_info" style="background: <?= $item->color ?>; border-color: <?= $item->color ?>;">
                                    <div class="svc_name"><?= $item->title ?></div>

                                    <div class="svc_txt">
                                        <?= strip_tags($item->content) ?>
                                    </div>
                                </div>
                            </div>


                            <div class="svc_it_col col-lg-6">
                                <div class="svc_img bg-cover" style="background-image:url('/uploads/<?= $item->path ?>');"></div>
                            </div>

                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php endif; ?>


                </div>
            </div>

        </div>
        <!-- |========== Service ==========| -->
    </section>

</main>