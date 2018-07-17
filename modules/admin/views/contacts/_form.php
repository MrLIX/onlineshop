<?php

use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use unclead\multipleinput\MultipleInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Contacts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contacts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content_ru')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions('elfinder', [ 'height' => 200 ]),
    ]); ?>

    <?= $form->field($model, 'content_en')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions('elfinder', [ 'height' => 200 ]),
    ]); ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'main_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emial')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lat', ['options' => ['class' => 'hidden']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lng', ['options' => ['class' => 'hidden']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phones')->widget(MultipleInput::className(), [
            'max' => '6',
            'columns' => [
                    [
                            'name' => 'phone',
                            'type' => 'textInput',
                            'title' => 'Phone',
                            'options' => [
                                    'placeholder' => '+998 90 123-4567'
                            ]
                    ],
                    [
                            'name' => 'lang_ru',
                            'type' => 'checkbox',
                            'title' => 'Ru',
                    ],
                    [
                        'name' => 'lang_uz',
                        'type' => 'checkbox',
                        'title' => 'Uz',
                    ],
                    [
                        'name' => 'lang_en',
                        'type' => 'checkbox',
                        'title' => 'En',
                    ],
            ],
        'addButtonOptions' => ['class' => 'btn btn-success']
    ])->label(false); ?>

    <div class="ordering-map" style="margin-bottom: 30px">

        <div class="ordering-map-h4" style="margin-bottom: 10px">
            <h4>
                <?= Yii::t('app', 'Address') ?>
            </h4>
        </div>
        <div class="ordering-map-img">

            <div id="floating-panel">
                <input onclick="deleteMarkers();" type=button value="Delete marker">
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
                        var haightAshbury = {lat: 41.306688, lng: 69.281285};
                        ;


                        map = new google.maps.Map(document.getElementById('map'), {
                            zoom: 14,
                            center: haightAshbury,
                            mapTypeId: 'terrain'
                        });


                        // This event listener will call addMarker() when the map is clicked.
                        map.addListener('click', function (event) {
                            deleteMarkers();
                            if (i == 1) {
                                addMarker(event.latLng);
                                i = 2;
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

                        $('#contacts-lat').val(marker.getPosition().lat());
                        $('#contacts-lng').val(marker.getPosition().lng());

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
                        $('#contacts-lat').val('');
                        $('#contacts-lng').val('');
                        markers = [];
                    }


                </script>
                <script async defer
                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAlFroO7C1GYV5PKyg1IOXVvBp42eAZrBU&callback=initMap">
                </script>

            </div>

        </div>

    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
