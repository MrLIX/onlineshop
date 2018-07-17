<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'DY Florist';
?>

<main class="main">

    <!-- |=================================== Banner ===================================| -->
    <section class="banner_sec">
        <div class="banner_bg_bx">
        <?php if(!empty($carousel)): ?>
        <?php foreach ($carousel as $k => $item): ?>
                <div class="banner_bg bg-cover <?= $k == 0 ? 'active' : '' ?>" style="background-image:url('/uploads/<?= $item->path ?>');"></div>
        <?php endforeach; ?>
        <?php endif; ?>
        </div>

        <div class="container">
            <div class="banner_bx us-n">
                <div class="banner">
                    <?php if(!empty($carousel)): ?>
                        <?php foreach ($carousel as $k => $item): ?>
                            <div class="banner_it">
                                <div class="banner_txt">
                                    <h2 class="banner_name"><?= $item->title ?></h2>
                                    <p class="banner_capt"><?= $item->content ?></p>
                                </div>

                                <div class="banner_more">
                                    <a href="<?= $item->url ?>" class="base_btn solid_pink"><?= Yii::t('app','подробнее') ?></a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>


                <div class="banner_nav">
                    <div class="banner_btn fx-c prev">
                        <svg x="0px" y="0px" width="200px" height="200px" viewBox="0 0 477.175 477.175"
                             style="enable-background:new 0 0 477.175 477.175;" xml:space="preserve">
							<g>
                                <path d="M145.188,238.575l215.5-215.5c5.3-5.3,5.3-13.8,0-19.1s-13.8-5.3-19.1,0l-225.1,225.1c-5.3,5.3-5.3,13.8,0,19.1l225.1,225 c2.6,2.6,6.1,4,9.5,4s6.9-1.3,9.5-4c5.3-5.3,5.3-13.8,0-19.1L145.188,238.575z"/>
                            </g>
						</svg>
                    </div>
                    <div class="banner_btn fx-c next">
                        <svg x="0px" y="0px" width="200px" height="200px" viewBox="0 0 477.175 477.175"
                             style="enable-background:new 0 0 477.175 477.175;" xml:space="preserve">
							<g>
                                <path d="M360.731,229.075l-225.1-225.1c-5.3-5.3-13.8-5.3-19.1,0s-5.3,13.8,0,19.1l215.5,215.5l-215.5,215.5 c-5.3,5.3-5.3,13.8,0,19.1c2.6,2.6,6.1,4,9.5,4c3.4,0,6.9-1.3,9.5-4l225.1-225.1C365.931,242.875,365.931,234.275,360.731,229.075z"/>
                            </g>
						</svg>
                    </div>
                </div>
            </div>
        </div>
        <!-- |========== Banner ==========| -->
    </section>



    <!-- |=================================== Service ===================================| -->
    <section class="service_sec">
        <div class="container">

            <div class="service">
                <h2 class="base_title"><?= Yii::t('app','Наши услуги') ?></h2>


                <div class="service_cnt">
                    <div class="row_home">

                        <?php if(!empty($services)): ?>
                            <?php foreach ($services as $k => $item): ?>
                                <div class="col_home <?= (($k == 1) || ($k == 2)) ? 'sm' : 'lg' ?>">
                                    <div class="service_it bg-cover" style="background-image:url('/uploads/<?= $item->path ?>');">
                                        <div class="service_capt">
                                            <div class="service_name"><?= $item->title ?></div>

                                            <div class="service_txt">
                                               <?= mb_substr(strip_tags($item->content), 0,160); ?>..
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>


                <div class="service_more">
                    <a href="<?= Url::to(['/site/our-services']) ?>" class="base_btn border_white"><?= Yii::t('app','подробнее') ?></a>
                </div>
            </div>

        </div>
        <!-- |========== Service ==========| -->
    </section>



    <!-- |=================================== Product ===================================| -->
    <section class="product_sec">
        <div class="product_bg bg-cover" style="background-image:url('/img/home/section_bg_2.png');"></div>

        <div class="container">

            <div class="product">
                <h2 class="base_title"><?= Yii::t('app','Наша продукция') ?></h2>


                <div class="product_cnt">
                    <div class="row_home">
                <?php if(!empty($categories)): ?>
                    <?php foreach ($categories as $k => $item): ?>
                        <div class="col_home <?= (($k == 1) || ($k == 2)) ? 'sm' : 'lg' ?>">
                            <a href="<?php
                            if($k == 0 || $k == 1){
                                echo Url::to(['/product/category','id' => $item->id]);
                            } else{
                                echo Url::to(['/product/sub-category','id' => $item->id]);
                            }
                            ?>" class="product_it bg-cover" style="background-image:url('/uploads/<?= $item->path ?>');">
                                <div class="product_capt">
                                    <div class="product_name"><?= $item->title ?></div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

                    </div>
                </div>
            </div>

        </div>
        <!-- |========== Product ==========| -->
    </section>



    <!-- |=================================== Advantage ===================================| -->
    <section class="advg_sec">
        <div class="container">

            <div class="advg">
                <h2 class="base_title"><?= Yii::t('app','Преимущества работы с нами') ?></h2>


                <div class="advg_cnt">

                    <?php if($advantages): ?>
                        <?php foreach ($advantages as $item): ?>
                         <div class="advg_it">
                        <div class="advg_img">
                            <img src="/uploads/<?= $item->path ?>" alt="">
                        </div>

                        <div class="advg_txt"><?= $item->title ?></div>
                    </div>
                        <?php endforeach; ?>
                    <?php endif;?>



                </div>
            </div>

        </div>
        <!-- |========== Advantage ==========| -->
    </section>

</main>