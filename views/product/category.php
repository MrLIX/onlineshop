<?php
/**
 * Created by PhpStorm.
 * User: SoS
 * Date: 19.06.2018
 * Time: 14:43
 */

use yii\helpers\Url;

$this->title = 'DY Florist';
?>

<!-- |************************************************** Main **************************************************| -->
<main class="main bg_white">

    <!-- |=================================== Inner Banner ===================================| -->
    <section class="inner_bnr_sec">
        <div class="inner_bnr_bg bg-cover" style="background-image:url('/uploads/<?= $cat->path ?>'); height: 400px;"></div>
        <!-- |========== Inner Banner ==========| -->
    </section>



    <!-- |=================================== Slice Flower ===================================| -->
    <section class="slice_f_sec">
        <div class="container">

            <div class="slice_f">
                <h3 class="inr_title slice_f_ttl"><?= $cat->title ?></h3>


                <div class="slice_f_cnt">
                    <div class="slice_f_gal">
                    <?php foreach ($category as $item): ?>
                        <div class="slice_f_gal_it">
                            <a href="<?= Url::to(['/product/sub-category', 'id' => $item->id]) ?>" class="product_it">
                                <img class="slice_f_gal_img" src="/uploads/<?= $item->path ?>" alt="">

                                <div class="product_capt">
                                    <div class="product_name"><?= $item->title ?></div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>

                    </div>
                </div>
            </div>

        </div>
        <!-- |========== Service ==========| -->
    </section>

</main>
<!-- |********** Main **********| -->
