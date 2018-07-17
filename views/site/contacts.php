<?php
/**
 * Created by PhpStorm.
 * User: SoS
 * Date: 19.06.2018
 * Time: 14:01
 */
$this->title = 'Contacts';
?>

<!-- |************************************************** Main **************************************************| -->
<main class="main bg_white">

    <!-- |=================================== Contacts ===================================| -->
    <section class="contact_sec">
        <div class="container">
            <div class="contact">
                <h3 class="inr_title thanks_ttl contact_ttl"><?= $contact->title ?></h3>


                <div class="contact_cnt">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="contact_map">
                                <div class="contact_map_ttl"><?= Yii::t('app','Карта проезда') ?></div>

                                <div class="contact_map_cnt">


                                        <input id="lat" type="hidden" value="<?= $contact->lat; ?>" />
                                        <input id="lng" type="hidden" value="<?= $contact->lng; ?>" />
                                        <div class="mapsColl">

                                            <div class="field" id="map3" style="height: 340px; width: 100% ">
                                                <script>



                                                    function initMap( ) {
                                                        var lat1 = Number(document.getElementById("lat").value);
                                                        var lng1 = Number(document.getElementById("lng").value);
                                                        var uluru = {lat: lat1, lng: lng1};
                                                        var map = new google.maps.Map(document.getElementById('map3'), {
                                                            zoom: 15,
                                                            center: uluru

                                                        });
                                                        var marker = new google.maps.Marker({

                                                            position: uluru,
                                                            map: map
                                                        });
                                                    }


                                                </script>
                                                <script async defer
                                                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAlFroO7C1GYV5PKyg1IOXVvBp42eAZrBU&callback=initMap">
                                                </script>

                                            </div>

                                        </div>


                                </div>
                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class="contact_txt">
                                <div class="contact_name">
                                  <?= $contact->content ?>
                                </div>

                                <ul class="ft_info_cont_ls contact_info_ls">
                                    <li>
                                        <div class="ft_info_cont_it">
                                            <i class="fas fa-map-marker-alt"></i>

                                            <div class="txt"><?= $contact->address ?></div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="ft_info_cont_it">
                                            <i class="far fa-envelope"></i>

                                            <div class="txt"><?= $contact->main_email ?></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="ft_info_cont_it">
                                            <i class="far fa-envelope"></i>

                                            <div class="txt"><?= $contact->emial ?></div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="ft_info_cont_it">
                                            <i class="fas fa-phone"></i>

                                            <div class="txt">
                                                <?php if(!empty($phones)): ?>
                                                    <?php foreach ($phones as $item): ?>
                                                        <ul class="ft_info_cont_tel">
                                                            <li><?= $item->phone ?></li>
                                                            <?php if($item->lang_uz == 1): ?>
                                                                <li>
                                                                    <img src="/img/flag_uz.png" alt="">
                                                                </li>
                                                            <?php endif; ?>
                                                            <?php if($item->lang_ru == 1): ?>
                                                                <li>
                                                                    <img src="/img/flag_ru.png" alt="">
                                                                </li>
                                                            <?php endif; ?>
                                                            <?php if($item->lang_en == 1): ?>
                                                                <li>
                                                                    <img src="/img/flag_en.png" alt="">
                                                                </li>
                                                            <?php endif; ?>

                                                        </ul>

                                                    <?php endforeach; ?>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- |========== Contacts ==========| -->
    </section>

</main>
<!-- |********** Main **********| -->