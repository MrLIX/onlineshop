<?php
/**
 * Created by PhpStorm.
 * User: SoS
 * Date: 20.06.2018
 * Time: 9:58
 */

use app\models\UserFavorites;
use yii\helpers\Url;
$this->title = 'DY Florist';
?>

<!-- |************************************************** Main **************************************************| -->
<main class="main bg_white">

    <!-- |=================================== Product One ===================================| -->
    <section class="prod_sec">
        <div class="container">
            <div class="prod">
                <h3 class="inr_title thanks_ttl prod_ttl"><?= $product->title ?></h3>
                <input class="hidden" value="<?= Yii::t('app', 'Ваш продукт добавлен в корзину!') ?>" id="swal1">


                <div class="prod_cnt">
                    <div class="prod_view_bx">
                        <div class="prod_view">
                            <div class="row">

                                <div class="col-lg-7">
                                    <div class="prod_img_bx">
                                        <div class="prod_img_thumb">
                                            <div class="prod_img_thumb_bnr">
                                                <div class="prod_img_thumb_col">
                                                    <div class="prod_img_thumb_it fx-c"><img src="/uploads/<?= $product->path ?>" alt=""></div>
                                                </div>
                                        <?php foreach ($product->productImages as $item): ?>
                                                <div class="prod_img_thumb_col">
                                                    <div class="prod_img_thumb_it fx-c"><img src="/uploads/<?= $item->path ?>" alt=""></div>
                                                </div>
                                        <?php endforeach; ?>

                                            </div>
                                        </div>


                                        <div class="prod_img">
                                            <div class="prod_img_bnr">
                                                <div class="prod_img_it">
                                                    <img class="xzoom" src="/uploads/<?= $product->path ?>" xoriginal="/uploads/<?= $product->path ?>" alt="">
                                                </div>
                                                <?php foreach ($product->productImages as $item): ?>
                                                <div class="prod_img_it">
                                                    <img class="xzoom" src="/uploads/<?= $item->path ?>" xoriginal="/uploads/<?= $item->path ?>" alt="">
                                                </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-5">
                                    <div class="prod_info">
                                        <form id="add-to-cart" action="<?= Url::to(['/product/add-to-card']) ?>" method="get" >
                                            <input name="id" type="hidden" value="<?= $product->id ?>">
                                            <div class="prod_price_bx">
                                                <div class="prod_price_hd">
                                                    <div class="prod_price">
                                                        <?php if(!empty($product->discount)): ?>
                                                            <p class="old"><?= number_format($product->price,'0','.',' ') ?> <?= Yii::t('app','сум') ?></p>
                                                            <p class="new"><?= number_format($product->discount_price,'0','.',' ') ?> <?= Yii::t('app','сум') ?></p>
                                                        <?php else: ?>
                                                            <p class="new"><?= number_format($product->price,'0','.',' ') ?> <?= Yii::t('app','сум') ?></p>
                                                        <?php endif; ?>
                                                    </div>
                                                    <?php if(!empty($product->discount)): ?>
                                                    <div class="prod_price_per">- <?= $product->discount ?>%</div>
                                                    <?php endif; ?>
                                                </div>
                                                <?php if($product->status == 1): ?>
                                                   <div class="prod_price_ft"><?= Yii::t('app','Товар в наличии') ?></div>
                                                <?php else: ?>
                                                    <div class="prod_price_ft"><?= Yii::t('app','Товар нет в наличии') ?></div>
                                                <?php endif; ?>

                                            </div>


                                            <div class="prod_act">
                                                <div class="prod_type_bx">
                                                    <div class="prod_type">
                                                        <div class="prod_type_ttl"><?= Yii::t('app','Параметры цветка') ?>:</div>

                                                        <div class="prod_type_cnt">
                                                            <div class="prod_type_it">
                                                                <div class="basket_amt_sel prod_type_sel">
                                                                    <select class="ap-n" name="color" required>
                                                                        <?php if(!empty($colors)):  ?>
                                                                            <?php foreach ($colors as $item): ?>
                                                                                <option value="<?= $item->id ?>"><?= $item->title ?></option>
                                                                             <?php endforeach; ?>
                                                                        <?php endif; ?>

                                                                    </select>

                                                                    <i class="fas fa-angle-down"></i>
                                                                </div>
                                                            </div>

                                                            <div class="prod_type_it">
                                                                <div class="basket_amt_sel prod_type_sel">
                                                                    <select class="ap-n" name="type" required>
                                                                        <?php if(!empty($types)):  ?>
                                                                            <?php foreach ($types as $item): ?>
                                                                                <option value="<?= $item->id ?>"><?= $item->title ?></option>
                                                                            <?php endforeach; ?>
                                                                        <?php endif; ?>
                                                                    </select>

                                                                    <i class="fas fa-angle-down"></i>
                                                                </div>
                                                            </div>

                                                            <div class="prod_type_it">
                                                                <div class="prod_type_qtt">
                                                                    <div class="txt"><?= Yii::t('app','Количество') ?>:</div>

                                                                    <div class="val">
                                                                        <div class="basket_amt_sel">
                                                                            <select class="ap-n" name="count" required>
                                                                                <?php if(!empty($count)):  ?>
                                                                                    <?php foreach ($count as $item): ?>
                                                                                        <option value="<?= $item ?>"><?= $item ?></option>
                                                                                    <?php endforeach; ?>
                                                                                <?php endif; ?>
                                                                            </select>

                                                                            <i class="fas fa-angle-down"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="prod_btn_bx">
                                                        <div class="prod_btn like">
                                                            <a href="#" class="base_btn solid_pink add-to-favorites" data-id="<?= $product->id ?>" data-url="<?= Url::to(['/product/add-favorites']) ?>" data-url-del="<?= Url::to(['/product/del-favorites']) ?>">
                                                                <span class="txt"><?= Yii::t('app','в избранное') ?></span>

                                                                <svg x="0px" y="0px" width="200px" height="200px" viewBox="0 0 485 485"
                                                                     style="enable-background:new 0 0 485 485;" xml:space="preserve">
                                                                    <g>
                                                                        <path
                                                                            d="M343.611,22.543c-22.613,0-44.227,5.184-64.238,15.409c-13.622,6.959-26.136,16.205-36.873,27.175 c-10.738-10.97-23.251-20.216-36.873-27.175c-20.012-10.225-41.625-15.409-64.239-15.409C63.427,22.543,0,85.97,0,163.932 c0,55.219,29.163,113.866,86.678,174.314c48.022,50.471,106.816,92.543,147.681,118.95l8.141,5.261l8.141-5.261 c40.865-26.406,99.659-68.479,147.682-118.95C455.838,277.798,485,219.151,485,163.932C485,85.97,421.573,22.543,343.611,22.543z M376.589,317.566c-42.918,45.106-95.196,83.452-134.089,109.116c-38.893-25.665-91.171-64.01-134.088-109.116 C56.381,262.884,30,211.194,30,163.932c0-61.42,49.969-111.389,111.389-111.389c35.361,0,67.844,16.243,89.118,44.563 l11.993,15.965l11.993-15.965c21.274-28.32,53.757-44.563,89.118-44.563c61.42,0,111.389,49.969,111.389,111.389 C455,211.194,428.618,262.884,376.589,317.566z"/>
                                                                    </g>
                                                                </svg>
                                                            </a>
                                                        </div>

                                                        <div class="prod_btn cart">
                                                            <a href="#" class="base_btn solid_pink add-to-cart">
                                                                <span class="txt "><?= Yii::t('app','в корзину') ?></span>

                                                                <svg x="0px" y="0px" width="200px" height="200px" viewBox="0 0 512 512"
                                                                     style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                                                    <g>
                                                                        <path
                                                                            d="M418.783,334.787c15.559-11.689,26.828-27.669,32.601-46.23L512,109.102H122.337l-4.299-47.67 c-1.479-16.766-9.13-32.261-21.543-43.627C84.081,6.439,67.975,0.178,51.143,0.178H0v39.972h51.143 c14.189,0,25.83,10.659,27.08,24.834l31.281,346.847c0.005,0.062,0.011,0.123,0.017,0.185 c3.049,30.622,26.04,54.542,55.415,59.526c7.833,23.379,29.927,40.279,55.909,40.279c25.497,0,47.26-16.272,55.465-38.973h46.959 c8.205,22.701,29.968,38.973,55.465,38.973c32.51,0,58.959-26.45,58.959-58.959c0-32.509-26.449-58.959-58.959-58.959 c-25.497,0-47.26,16.272-55.465,38.973h-46.959c-8.205-22.701-29.968-38.973-55.465-38.973c-24.644,0-45.792,15.203-54.59,36.718 c-9.159-3.636-15.886-12.105-16.95-22.484l-4.979-55.206h220.418C384.294,352.932,402.98,346.658,418.783,334.787z M378.736,433.876c10.47,0,18.987,8.517,18.987,18.987s-8.517,18.987-18.987,18.987c-10.47,0-18.987-8.517-18.987-18.987 S368.266,433.876,378.736,433.876z M220.846,433.876c10.47,0,18.987,8.517,18.987,18.987s-8.517,18.987-18.987,18.987 s-18.987-8.517-18.987-18.987S210.376,433.876,220.846,433.876z M140.722,312.961v-0 001l-14.781-163.886h330.366l-42.875,126.932 l-0.167,0.519c-6.6,21.453-26.552,36.436-48.519,36.436H140.722z"/>
                                                                    </g>
                                                                </svg>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="prod_pay">
                                                    <div class="prod_pay_ttl"><?= Yii::t('app','Способ оплаты') ?>:</div>

                                                    <div class="prod_pay_cnt">
                                                        <ul class="prod_pay_ls us-n">
                                                        <?php if($payment): ?>
                                                            <?php foreach ($payment as $item): ?>
                                                                <li>
                                                                    <div class="prod_pay_it">
                                                                        <img src="/uploads/<?= $item->path ?>" alt="">

                                                                    </div>
                                                                </li>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="prod_desc">
                            <div class="prod_desc_ttl"><?= Yii::t('app','Полное описание товара') ?></div>

                            <div class="prod_desc_cnt">
                                <p>
                                   <?= $product->content ?>
                                </p>
                            </div>
                        </div>
                    </div>


                    <div class="prod_rcmd">
                        <h2 class="base_title prod_rcmd_ttl"><?= Yii::t('app','Также у нас покупали') ?></h2>

                        <div class="prod_rcmd_cnt">
                            <div class="row flower_row">
                            <?php if(!empty($most)): ?>
                                <?php foreach ($most as $item): ?>
                                  <div class="col-lg-4 col-md-6 flower_col">
                                    <div class="flower">
                                        <div class="flower_img_bx">
                                            <a href="<?= Url::to(['/product/product','id' => $item->id]) ?>" class="flower_img fx-c">
                                                <img src="/uploads/<?= $item->path ?>" alt="">
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
                                          <?php if(!empty($item->discount)): ?>
                                            <div class="flower_per">-<?= $item->discount ?>%</div>
                                          <?php endif; ?>
                                        </div>

                                        <div class="flower_txt">
                                            <div class="flower_name"><?= $item->title ?></div>

                                            <div class="flower_price">
                                                <?php if(!empty($item->discount)): ?>
                                                    <div class="new"><?= number_format($item->discount_price,'0','.',' ') ?> <?= Yii::t('app','сум') ?></div>
                                                    <div class="old"><?= number_format($item->price,'0','.',' ') ?> <?= Yii::t('app','сум') ?></div>
                                                <?php else: ?>
                                                    <div class="new"><?= number_format($item->price,'0','.',' ') ?> <?= Yii::t('app','сум') ?></div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- |========== Product One ==========| -->
    </section>

</main>
<!-- |********** Main **********| -->
