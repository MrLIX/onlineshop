<?php
/**
 * Created by PhpStorm.
 * User: SoS
 * Date: 19.06.2018
 * Time: 15:17
 */

use app\models\UserFavorites;
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
                    <h3 class="inr_title search_p_ttl"><?= $category->title ?></h3>
                </div>
            </div>

            <div class="search_p_nav_bx">
                <div class="container">
                    <form id="filter-category" action="<?= Url::to(['/product/filter-ajax']) ?>" method="get">
                        <input type="hidden" name="id" value="<?= $category->id ?>">
                        <div class="search_p_nav">
                            <div class="row">

                                <div class="col-lg-6 search_p_nav_col">
                                    <div class="search_p_nav_sch">
                                        <input type="search" name="q" class="inp"
                                               placeholder="<?= Yii::t('app', 'Поиск') ?>">

                                        <button class="bt fx-c">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>


                                <div class="col-lg-6 search_p_nav_col">
                                    <div class="search_p_nav_opt">
                                        <ul class="search_p_nav_opt_ls us-n">

                                            <li>
                                                <div class="search_p_nav_chk">
                                                    <span class="txt filter"><?= Yii::t('app', 'Новинки') ?></span>
                                                    <input name="news" type="checkbox" class="inp" hidden>
                                                </div>
                                            </li>

                                            <li>
                                                <a href="">
                                                    <span class="txt"><?= Yii::t('app', 'Тип') ?></span>
                                                    <i class="fas fa-angle-down"></i>
                                                </a>

                                                <ul class="search_p_nav_drop type">
                                                    <?php if (!empty($types)): ?>
                                                        <?php foreach ($types as $item): ?>
                                                            <li>
                                                                <span class="txt filter"><?= $item->title ?></span>
                                                                <input name="type" value="<?= $item->id ?>"
                                                                       type="checkbox" class="inp" hidden>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>

                                                </ul>
                                            </li>

                                            <li>
                                                <a href="">
                                                    <span class="txt"><?= Yii::t('app', 'Цвет') ?></span>
                                                    <i class="fas fa-angle-down"></i>
                                                </a>
                                                <ul class="search_p_nav_drop clr">
                                                    <?php if (!empty($colors)): ?>
                                                        <?php foreach ($colors as $item): ?>
                                                            <li>
                                                                <span class="color filter"
                                                                      style="background:<?= $item->color ?>;"></span>
                                                                <input name="color" value="<?= $item->id ?>"
                                                                       type="checkbox" class="inp" hidden>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>

                                                </ul>
                                            </li>

                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <div id="pord">
        <div class="search_p_bd">
            <div class="container">
                <div class="row flower_row">
                    <?php if ($products): ?>
                        <?php foreach ($products as $item): ?>
                            <div class="col-lg-4 col-md-6 flower_col">
                                <div class="flower">
                                    <div class="flower_img_bx">
                                        <a href="<?= Url::to(['product/product','id' => $item->id]) ?>" class="flower_img fx-c">
                                            <img src="/uploads/<?= $item->path ?>" alt="<?= $item->title ?>">
                                        </a>
                                        <?php
                                        $fav_check = 0;
                                            if(Yii::$app->user->isGuest){ // Если Гость, проверяем из Сессии

                                               if(!empty(Yii::$app->session['favorites'])){
                                                   $favorite = Yii::$app->session['favorites'];
                                                   foreach ($favorite as $fav){
                                                       if($fav == $item->id){
                                                           $fav_check = 1;
                                                       }
                                                   }
                                               }

                                            } else{                       // Если не Гость, проверяем из таблицы user_favorites
                                                $favorite = UserFavorites::find()->where(['user_id' => Yii::$app->user->id, 'product_id' => $item->id])->one();
                                                if(!empty($favorite)){
                                                    $fav_check = 1;
                                                }
                                            }
                                        if($fav_check == 1){ ?>
                                        <div class="flower_act like fx-c del-favorites active" data-id="<?= $item->id ?>" data-url="<?= Url::to(['/product/add-favorites']) ?>" data-url-del="<?= Url::to(['/product/del-favorites']) ?>">

                                        <?php } else{ ?>
                                        <div class="flower_act like fx-c add-favorites" data-id="<?= $item->id ?>" data-url="<?= Url::to(['/product/add-favorites']) ?>" data-url-del="<?= Url::to(['/product/del-favorites']) ?>">

                                        <?php }    ?>
                                            <svg x="0px" y="0px" width="200px" height="200px" viewBox="0 0 485 485"
                                                 style="enable-background:new 0 0 485 485;" xml:space="preserve">
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
                    <?php else: ?>
                        <h3 style="min-height: 400px; margin: 10px"><?= Yii::t('app', 'Продукт еще не добавлен') ?></h3>
                    <?php endif; ?>
                </div>
            </div>
        </div>

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
        </div>
        <!-- |========== Search Product ==========| -->
    </section>

</main>
<!-- |********** Main **********| -->