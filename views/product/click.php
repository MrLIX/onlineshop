<?php
/**
 * Created by PhpStorm.
 * User: SoS
 * Date: 16.07.2018
 * Time: 11:55
 */
?>

<?php

$this->registerJs('
    $("#click_form").submit();
    ');

$secret = '<KEY>';
$date = date("Y-m-d h:i:s");
$merchantID = '';
$merchantUserID = '';
$serviceID = '';
$transID = $order->id;
$transAmount = number_format($order->amount, 2, '.', '');
$signString = md5 ($date. $secret. $serviceID. $transID. $transAmount);
$returnURL = 'http://dyflorist.com/product/thanks?id='.$order->id;
?>

<form action="https://my.click.uz/pay/" id="click_form" method="post">
<input id="click_amount_field" type="hidden" name="MERCHANT_TRANS_AMOUNT" value="<?= $transAmount ?>" class="click_input" />
<input type="hidden" name="MERCHANT_ID" value="<?= $merchantID ?>"/>
<input type="hidden" name="MERCHANT_USER_ID" value="<?= $merchantUserID ?>"/>
<input type="hidden" name="MERCHANT_SERVICE_ID" value="<?= $serviceID ?>"/>
<input type="hidden" name="MERCHANT_TRANS_ID" value="<?= $transID ?>"/>
<input type="hidden" name="MERCHANT_TRANS_NOTE" value="Оплата OOO  MERCHANT"/>
<input type="hidden" name="MERCHANT_USER_PHONE" value="<?= $order->phone ?>"/>
<input type="hidden" name="MERCHANT_USER_EMAIL" value="mail@server.com"/>
<input type="hidden" name="SIGN_TIME" value="<?= $date ?>"/>
<input type="hidden" name="SIGN_STRING" value="<?= $signString ?>"/>
<input type="hidden" name="RETURN_URL" value="<?= $returnURL ?>"/>
                                                        
</form>

