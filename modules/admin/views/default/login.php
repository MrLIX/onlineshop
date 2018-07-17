<?php
/**
 * Created by PhpStorm.
 * User: Farhodjon
 * Date: 09.03.2018
 * Time: 16:50
 */

use yii\bootstrap\ActiveForm;

$this->title = 'Login to admin panel';

?>
<div class="unix-login">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="login-content card">
                    <div class="login-form">
                        <h4>Login</h4>
                        <?php $form = ActiveForm::begin() ?>
                        <?= $form->field($model, 'username')->textInput() ?>
                        <?= $form->field($model, 'password')->passwordInput() ?>
                        <?= $form->field($model, 'rememberMe')->checkbox() ?>
                        <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Sign in</button>
                        <?php ActiveForm::end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
