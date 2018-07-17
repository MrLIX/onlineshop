<?php
/**
 * Created by PhpStorm.
 * User: SoS
 * Date: 13.07.2018
 * Time: 17:20
 */

$returnURL = 'http://dyflorist.com/product/thanks?id='.$order->id;
?>
<body>
<?php    $this->registerJs('
    $(".paycom-form").submit();
    ');
?>
<form method="POST" action="https://checkout.paycom.uz/" class="paycom-form">


    <input type="hidden" name="merchant" value="<ID>"/>

    <?php $amount = $order->amount * 100 ?>

    <input type="hidden" name="amount" value="<?= $amount ?>"/>

    <input type="hidden" name="callback" value="<?= $returnURL ?>"/>

    <input type="hidden" name="account[order_id]" value="<?= $order->id ?>"/>


</form>
</body>