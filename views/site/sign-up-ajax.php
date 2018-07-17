<?php
/**
 * Created by PhpStorm.
 * User: SoS
 * Date: 22.06.2018
 * Time: 11:43
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>
<div class="modal-dialog">
    <div class="modal-content">
        <button type="button" class="base_modal_close" data-dismiss="modal">
            <i class="fas fa-times"></i>
        </button>

        <div class="modal-body">
            <?php ActiveForm::begin([
                'action' => Url::to(['/site/get-sms']),
                'method' => 'get',
                'id' => 'get-sms',
//                'enableAjaxValidation' => true
            ]) ?>
            <div class="base_modal_hd"><?= Yii::t('app', 'Регистрация на DY Florist') ?></div>


            <div class="base_modal_bd">
                <div class="base_modal_fld">
                    <input name="id" id="id" value="<?= $user->id ?>" hidden>

                    <div class="psnl_data_gr">
                        <?= Html::input('tel', 'phone', '', ['class' => 'reg_pop_inp base_modal_inp', 'id' => 'phone', 'required' => true, 'maxlength' => '13', 'minlength' => '13', 'data-code-active', 'placeholder' => Yii::t('app', '* Номер телефона')]) ?>
                    </div>


                    <div class="psnl_data_gr">
                        <div class="fmlz_info_code base_modal_code">
                            <div class="fmlz_info_code_fld">
                                <div class="fmlz_info_code_btn">
                                    <button type="button" class="base_btn solid_violet psnl_data_btn get-code" data-code
                                            data-code-active><?= Yii::t('app', 'Получить код') ?>
                                    </button>
                                </div>


                                <input name="sms" id="sms" hidden>

                                <div class="fmlz_info_code_inp">
                                    <input type="text" name="code" id="code" class="reg_pop_inp base_modal_inp"
                                           placeholder="Введите код" data-code-disabled disabled="disabled">
                                </div>
                            </div>

                            <div class="fmlz_info_code_txt">
                                <div class="fmlz_info_code_lbl"><?= Yii::t('app', 'Мы отправили Вам код через смс') ?></div>

                                <div class="fmlz_info_code_again">
                                    <a href="#" class="bt get-code"><?= Yii::t('app', 'Попробуйте снова') ?></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <div class="base_modal_ft">
                <button name="s2" type="submit" class="base_btn solid_violet"><?= Yii::t('app', 'Отправить') ?>
                </button>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
