<?php
/**
 * Created by PhpStorm.
 * User: SoS
 * Date: 23.06.2018
 * Time: 15:56
 */

use app\models\Region;
use yii\helpers\Url;

?>
<!-- |************************************************** Main **************************************************| -->
<main class="main bg_white">

    <!-- |=================================== Personal Data ===================================| -->
    <section class="data_sec">
        <div class="container">

            <div class="data">
                <h3 class="inr_title data_ttl"><?= Yii::t('app','Личные данные') ?></h3>

                <div class="data_cnt">
                    <div class="data_tab">

                        <div class="data_tab_ttl">
                            <ul class="data_tab_ls us-n psnl_data_ls">
                                <li class="active"><?= Yii::t('app','Личные данные') ?></li>
                                <li><?= Yii::t('app','Адрес доставки') ?></li>
                                <li><?= Yii::t('app','История заказов') ?></li>
                            </ul>
                        </div>


                        <div class="data_tab_cnt">
                            <div class="data_tab_it active">
                                <div class="psnl_data psnl_data_info">

                                    <div class="psnl_data_it" style="display: block;">
                                        <div class="psnl_data_info_bd">
                                            <ul class="psnl_data_info_ls">
                                                <li>
                                                    <span class="txt"><?= Yii::t('app','Логин') ?>:</span>
                                                    <span class="val"><?= $user->username ?></span>
                                                </li>

                                                <li>
                                                    <span class="txt"><?= Yii::t('app','Ф.И.О.') ?>:</span>
                                                    <span class="val"><?= !empty($user_info->name) ? $user_info->name : '' ?></span>
                                                </li>

                                                <li>
                                                    <span class="txt"><?= Yii::t('app','E-mail') ?>:</span>
                                                    <span class="val"><?= $user->email ?></span>
                                                </li>

                                                <li>
                                                    <span class="txt"><?= Yii::t('app','Тел.') ?>:</span>
                                                    <span class="val"><?= !empty($user_info->phone) ? $user_info->phone : ''  ?></span>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="psnl_data_info_ft">
                                            <div class="psnl_data_btn_bx psnl_data_info_btn">
                                                <a href="" class="base_btn solid_violet psnl_data_btn" data-personal-data> <?= Yii::t('app','Редактировать') ?> </a>
                                            </div>

                                            <div class="psnl_data_info_chg_p">
                                                <a href="<?= Url::to(['/site/change-password', 'id' =>$user->id]) ?>"><?= Yii::t('app','Сменить пароль') ?></a>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="psnl_data_it">
                                        <form action="<?= Url::to(['/site/change-user']) ?>" method="get">
                                            <div class="psnl_data_fld">
                                                <div class="psnl_data_gr">
                                                    <input type="text" name="username" value="<?= $user->username ?>" class="psnl_data_inp" placeholder="<?= Yii::t('app','* Логин') ?>" required>
                                                </div>

                                                <div class="psnl_data_gr">
                                                    <input type="text"  name="name" value="<?= !empty($user_info->name) ? $user_info->name : '' ?>" class="psnl_data_inp" placeholder="<?= Yii::t('app','* Ф.И.О.') ?>" required>
                                                </div>

                                                <div class="psnl_data_gr multi">
                                                    <div class="psnl_data_gr_it">
                                                        <input type="email" name="email" value="<?= $user->email ?>" class="psnl_data_inp" placeholder="<?= Yii::t('app','* E-mail') ?>" required>
                                                    </div>

                                                    <div class="psnl_data_gr_it">
                                                        <input type="tel" name="phone" value="<?= !empty($user_info->phone) ? $user_info->phone : '' ?>"  class="psnl_data_inp" placeholder="<?= Yii::t('app','* Телефон') ?>" required>
                                                    </div>
                                                </div>

                                                <div class="psnl_data_btn_bx psnl_data_edit_btn">
                                                    <button type="submit" class="base_btn solid_violet"><?= Yii::t('app','Сохранить') ?></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>


                            <div class="data_tab_it">
                                <div class="psnl_data psnl_data_adrs">

                                    <div class="psnl_data_it" style="display: block;">
                                        <div class="psnl_data_info_bd">
                                            <ul class="psnl_data_info_ls">
                                                <li>
                                                    <span class="txt"><?= Yii::t('app','Регион') ?>:</span>
                                                    <span class="val">
                                                        <?php if(!empty($user_info->region_id)): ?>
                                                            <?= $user_info->rayon->region->region ?>
                                                        <?php endif; ?>
                                                    </span>
                                                </li>

                                                <li>
                                                    <span class="txt"><?= Yii::t('app','Район') ?>:</span>
                                                    <span class="val">
                                                        <?php if(!empty($user_info->region_id)): ?>
                                                            <?= $user_info->rayon->rayon ?>
                                                        <?php endif; ?>
                                                    </span>
                                                </li>

                                                <li>
                                                    <span class="txt"><?= Yii::t('app','Индекс') ?>:</span>
                                                    <span class="val"><?= !empty($user_info->index) ? $user_info->index : '' ?></span>
                                                </li>

                                                <li>
                                                    <span class="txt"><?= Yii::t('app','Улица') ?>:</span>
                                                    <span class="val"><?=!empty($user_info->address) ? $user_info->address : ''   ?></span>
                                                </li>

                                                <li>
                                                    <span class="txt"><?= Yii::t('app','Дом №') ?>:</span>
                                                    <span class="val"><?=!empty($user_info->number_dom) ? $user_info->number_dom : ''   ?></span>
                                                </li>

                                                <li>
                                                    <span class="txt"><?= Yii::t('app','Квартира №') ?>:</span>
                                                    <span class="val"><?=!empty($user_info->number_kv) ? $user_info->number_kv : ''   ?></span>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="psnl_data_info_ft">
                                            <div class="psnl_data_btn_bx psnl_data_info_btn">
                                                <a href="" class="base_btn solid_violet psnl_data_btn" data-personal-data><?= Yii::t('app','Редактировать') ?></a>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="psnl_data_it">
                                        <form action="<?= Url::to(['/site/change-address']) ?>" method="get">
                                            <div class="psnl_data_fld">
                                                <div class="psnl_data_gr">
                                                    <div class="psnl_data_inp_sel">
                                                        <select name="region" class="psnl_data_inp ap-n region" required>
                                                            <option disabled selected><?= Yii::t('app','Выберите Регион') ?></option>
                                                            <?php $region = Region::find()->all(); ?>
                                                            <?php foreach ($region as $item): ?>
                                                                <option value="<?= $item->id ?>"><?= $item->region ?></option>
                                                            <?php endforeach; ?>
                                                        </select>

                                                        <i class="fas fa-angle-down"></i>
                                                    </div>
                                                </div>

                                                <div class="psnl_data_gr">
                                                    <div class="psnl_data_inp_sel">
                                                        <select name="rayon" class="psnl_data_inp ap-n rayon" required>
                                                            <option disabled selected><?= Yii::t('app','Выберите Район') ?></option>
                                                        </select>

                                                        <i class="fas fa-angle-down"></i>
                                                    </div>
                                                </div>

                                                <div class="psnl_data_gr">
                                                    <input type="text" name="street" value="<?= !empty($user_info->address) ? $user_info->address : ''?>" class="psnl_data_inp" placeholder="<?= Yii::t('app','* Улица') ?>" required>
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

                                                <div class="psnl_data_btn_bx psnl_data_edit_btn">
                                                    <button type="submit" class="base_btn solid_violet " ><?= Yii::t('app','Сохранить') ?></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>


                            <div class="data_tab_it">
                                <?php if(!empty($orders)): ?>
                                <?php foreach ($orders as $item): ?>
                                    <div class="psnl_data psnl_data_book">

                                        <div class="psnl_data_book_ttl">
                                            <span class="num">№ <?= $item->id ?></span>
                                            /
                                            <span class="date"><?= date('d.m.Y',$item->created_at) ?></span>
                                        </div>


                                        <div class="psnl_data_book_cnt">
                                            <table class="psnl_data_book_tb">

                                                <thead>
                                                <tr>
                                                    <td><?=  Yii::t('app','Продукция')?></td>
                                                    <td><?=  Yii::t('app','О продукции')?></td>
                                                    <td><?=  Yii::t('app','Количество')?></td>
                                                    <td><?=  Yii::t('app','Итого')?></td>
                                                </tr>
                                                </thead>


                                                <tbody>
                                                <?php foreach ($item->orderProducts as $prod): ?>
                                                <tr>
                                                    <td>
                                                        <div class="psnl_data_book_img fx-c">
                                                            <img src="/uploads/<?= $prod->product->path ?>" alt="">
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="psnl_data_book_info">
                                                            <div class="basket_name psnl_data_book_name"><?= $prod->product->title ?></div>

                                                            <ul class="basket_info_ls psnl_data_book_info_ls">
                                                                <li>
                                                                    <span class="txt"><?= Yii::t('app','Цвет') ?>:</span>
                                                                    <span class="val"><?= $prod->color ?></span>
                                                                </li>

                                                                <li>
                                                                    <span class="txt"><?= Yii::t('app','Тип') ?>:</span>
                                                                    <span class="val"><?= $prod->type ?></span>
                                                                </li>

                                                                <li>
                                                                    <span class="txt"><?= Yii::t('app','Цена за штуку') ?>:</span>
                                                                    <span class="val"><?= number_format($prod->product_price, '0','.',' ') ?> <?= Yii::t('app','сум') ?></span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="psnl_data_book_num"><?= $prod->quantity ?></div>
                                                    </td>

                                                    <td>
                                                        <div class="psnl_data_book_tot"><?= number_format($prod->product_price*$prod->quantity, '0','.',' ') ?> <?= Yii::t('app','сум') ?></div>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>

                                                </tbody>

                                            </table>
                                        </div>

                                    </div>
                                <?php endforeach; ?>
                                <?php else: ?>
                                <div class="psnl_data psnl_data_book" style="padding-bottom: 130px">
                                <h3 style="margin: 30px;"><?= Yii::t('app','Вы еще ничего не закали!') ?></h3>
                                <?php endif; ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <!-- |========== Personal Data ==========| -->
    </section>

</main>
<!-- |********** Main **********| -->
