<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-form">

    <?php $form = ActiveForm::begin();                                                  ?>

    <?= $form->field($model, 'user_id')->textInput()                            ?>

    <?= $form->field($model, 'amount')->textInput()                             ?>

    <?= $form->field($model, 'state')->textInput()                              ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])          ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true])         ?>

    <?= $form->field($model, 'street')->textInput(['maxlength' => true])        ?>

    <?= $form->field($model, 'index')->textInput(['maxlength' => true])         ?>

    <?= $form->field($model, 'number_dom')->textInput(['maxlength' => true])    ?>

    <?= $form->field($model, 'number_kv')->textInput(['maxlength' => true])     ?>

    <?= $form->field($model, 'lat')->textInput(['maxlength' => true])           ?>

    <?= $form->field($model, 'lang')->textInput(['maxlength' => true])          ?>

    <?= $form->field($model, 'payment_id')->textInput()                         ?>

    <?= $form->field($model, 'created_at')->textInput()                         ?>

    <?= $form->field($model, 'updated_at')->textInput()                         ?>

    <?= $form->field($model, 'region_id')->textInput()                          ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
