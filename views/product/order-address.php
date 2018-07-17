<?php
/**
 * Created by PhpStorm.
 * User: SoS
 * Date: 25.06.2018
 * Time: 10:50
 */

use app\models\Region;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$region = Region::find()->all();
if(Yii::$app->user->isGuest):
    $order_id = Yii::$app->request->get('order_id');
endif;
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
                                <li><?= Yii::t('app','Личные данные') ?></li>
                                <li class="active"><?= Yii::t('app','Адрес доставки') ?></li>
                                <li><?= Yii::t('app','Способ оплаты') ?></li>
                            </ul>
                        </div>


                        <div class="data_tab_cnt">
                            <div class="fmlz fmlz_adrs">

                            <?php ActiveForm::begin([
                                    'action' => Url::to(['/product/order-payment']),
                                    'method' => 'GET',
                                    'id' => 'order-payment'
                            ]) ?>



                                <input name="order_id" value="<?= !empty($order_id) ? $order_id : '' ?>" hidden>
                                    <div class="psnl_data_fld">
                                        <div class="psnl_data_gr">
                                            <div class="psnl_data_inp_sel">
                                                <select class="psnl_data_inp ap-n region" name="region">
                                                    <?php if(!empty($user_info->rayon)): ?>
                                                        <option selected><?= $user_info->rayon->region->region ?></option>
                                                    <?php else: ?>
                                                        <option disabled selected><?= Yii::t('app','Выберите Регион') ?></option>
                                                    <?php endif; ?>
                                                    <?php foreach ($region as $item): ?>
                                                        <option value="<?= $item->id ?>"><?= $item->region ?></option>
                                                    <?php endforeach; ?>
                                                </select>

                                                <i class="fas fa-angle-down"></i>
                                            </div>
                                        </div>

                                        <div class="psnl_data_gr">
                                            <div class="psnl_data_inp_sel">
                                                <select class="psnl_data_inp ap-n rayon"  name="rayon">
                                                    <?php if(!empty($user_info->region_id)): ?>
                                                        <option selected value="<?= $user_info->rayon->id ?>"><?= $user_info->rayon->rayon ?></option>
                                                    <?php else:?>
                                                    <option disabled selected><?= Yii::t('app','Выберите Район') ?></option>
                                                    <?php endif; ?>
                                                </select>

                                                <i class="fas fa-angle-down"></i>
                                            </div>
                                        </div>

                                        <div class="psnl_data_gr">
                                            <input type="text" class="psnl_data_inp" name="street" value="<?= !empty($user_info->address) ? $user_info->address : ''?>" placeholder="<?= Yii::t('app','* Улица') ?>" required>
                                        </div>

                                        <div class="psnl_data_gr multi">
                                            <div class="psnl_data_gr_it">
                                                <input type="text" name="index" value="<?= !empty($user_info->index) ? $user_info->index : ''?>"  class="psnl_data_inp" placeholder="<?= Yii::t('app','Индекс') ?>">
                                            </div>

                                            <div class="psnl_data_gr_it">
                                                <input type="text" name="number_dom" value="<?= !empty($user_info->number_dom) ? $user_info->number_dom : ''?>" class="psnl_data_inp" placeholder="<?= Yii::t('app','№ Дом') ?>" required>
                                            </div>

                                            <div class="psnl_data_gr_it">
                                                <input type="text" name="number_kv" value="<?= !empty($user_info->number_kv) ? $user_info->number_kv : ''?>" class="psnl_data_inp" placeholder="<?= Yii::t('app','№ Квартира') ?>">
                                            </div>
                                        </div>

                                        <div class="psnl_data_gr">
                                            <div class="fmlz_adrs_map">
                                                <div class="fmlz_adrs_map_ttl"><?= Yii::t('app','Выберите место для доставки на карте') ?></div>

                                                <div class="fmlz_adrs_map_cnt">
                                                    <div class="ordering-map-img">

                                                        <div id="floating-panel">
                                                            <input onclick="deleteMarkers();" type=button value="Удалить выбраноое место">
                                                        </div>
                                                        <div class="field" id="map" style="height: 300px; width: 100%;">
                                                            <script>
                                                                var map;
                                                                var markers = [];
                                                                var i = 1;
                                                                var lat;
                                                                var lng;
                                                                function initMap() {
                                                                    // var lat1 = Number(document.getElementById("contacts-lat").value);
                                                                    // var lng1 = Number(document.getElementById("contacts-lng").value);
                                                                    var haightAshbury = {lat: 41.306688, lng: 69.281285};;



                                                                    map = new google.maps.Map(document.getElementById('map'), {
                                                                        zoom: 14,
                                                                        center: haightAshbury,
                                                                        mapTypeId: 'terrain'
                                                                    });



                                                                    // This event listener will call addMarker() when the map is clicked.
                                                                    map.addListener('click', function(event) {
                                                                        deleteMarkers();
                                                                        if( i == 1){addMarker(event.latLng);  i=2;
                                                                        }
                                                                    });
                                                                }


                                                                // Adds a marker to the map and push to the array.
                                                                function addMarker(location) {

                                                                    var marker = new google.maps.Marker({
                                                                        position: location,
                                                                        map: map
                                                                    });
                                                                    markers.push(marker);

                                                                    $('#lat').val(marker.getPosition().lat());
                                                                    $('#lng').val(marker.getPosition().lng());

                                                                }



                                                                // Sets the map on all markers in the array.
                                                                function setMapOnAll(map) {
                                                                    for (var i = 0; i < markers.length; i++) {
                                                                        markers[i].setMap(map);
                                                                    }

                                                                }

                                                                // Removes the markers from the map, but keeps them in the array.
                                                                function clearMarkers() {
                                                                    setMapOnAll(null);
                                                                }

                                                                // Shows any markers currently in the array.
                                                                function showMarkers() {
                                                                    setMapOnAll(map);
                                                                }

                                                                // Deletes all markers in the array by removing references to them.
                                                                function deleteMarkers() {
                                                                    clearMarkers();
                                                                    i = 1;
                                                                    $('#lat').val('');
                                                                    $('#lng').val('');
                                                                    markers = [];
                                                                }


                                                            </script>
                                                            <script async defer
                                                                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAlFroO7C1GYV5PKyg1IOXVvBp42eAZrBU&callback=initMap">
                                                            </script>

                                                        </div>
                                                        <input type="text" name="lat" id="lat" class="hidden"/>
                                                        <input type="text" name="lng" id="lng" class="hidden"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="fmlz_btn_bx psnl_data_edit_btn">
                                            <a href="<?= Url::to(['/product/order-info-return', 'order_id' => $order_id]) ?>" class="base_btn border_grey psnl_data_btn back"><?= Yii::t('app','Вернуться') ?></a>
                                            <button type="submit" class="base_btn solid_violet psnl_data_btn"><?= Yii::t('app','Продолжить') ?></button>
                                        </div>
                                    </div>
                                <?php ActiveForm::end(); ?>

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


