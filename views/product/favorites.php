<?php
/**
 * Created by PhpStorm.
 * User: SoS
 * Date: 20.06.2018
 * Time: 15:12
 */

use yii\helpers\Url;
$this->title = 'DY Florist';
?>
<!-- |************************************************** Main **************************************************| -->
<main class="main bg_white">

    <!-- |=================================== Search Product ===================================| -->
    <section class="search_p_sec">
        <div class="search_p_hd">
            <div class="search_p_ttl_bx">
                <div class="container">
                    <h3 class="inr_title search_p_ttl"><?= Yii::t('app','Избранное') ?></h3>
                </div>
            </div>
        </div>


        <div class="search_p_bd">
            <div class="container">
                <div class="row flower_row">
            <?php if(!empty($favorites)): ?>
                <?php foreach ($favorites as $item): ?>
                    <div class="col-lg-4 col-md-6 flower_col" data-flower-close>
                        <div class="flower">
                            <div class="flower_img_bx">
                                <a href="<?= Url::to(['product/product','id' => $item->id]) ?>" class="flower_img fx-c">
                                    <img src="/uploads/<?= $item->path ?>" alt="<?= $item->title ?>">
                                </a>


                                <div class="flower_close fx-c del-favorites" data-id="<?= $item->id ?>" data-url-del="<?= Url::to(['/product/del-favorites']) ?>">
                                    <i class="fas fa-times"></i>
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
            <?php else: ?>
                <h3 style="text-align: center; margin-bottom: 300px; padding: 10px"><?= Yii::t('app','Вы еще не добавили избранные товары') ?></h3>
            <?php endif; ?>
                </div>
            </div>
        </div>
        <?php if(!empty($pages)): ?>
        <div class="search_p_ft">
            <div class="container">
                <div class="search_p_pag">

                    <?php
                    echo \yii\widgets\LinkPager::widget([
                        'pagination' => $pages,
                        'options' => ['class' => 'search_p_pag_ls'],
                        'prevPageLabel' => false,
                        'nextPageLabel' => false,
                        'activePageCssClass' => 'active',

                    ]); ?>

                </div>
            </div>
        </div>
        <?php endif; ?>
        <!-- |========== Search Product ==========| -->
    </section>

</main>
<!-- |********** Main **********| -->

