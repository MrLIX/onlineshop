<?php
use yii\helpers\Url;
?>
<!-- Start Page Content -->
<div class="row">
    <div class="col-md-3">
        <div class="card p-30">
            <div class="media">
                <div class="media-left meida media-middle">
                    <span><i class="fa fa-usd f-s-40 color-primary"></i></span>
                </div>
                <div class="media-body media-text-right">
                    <h2><?= number_format($sum,'0','.',' ') ?></h2>
                    <p class="m-b-0">Total Revenue [sum]</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-30">
            <div class="media">
                <div class="media-left meida media-middle">
                    <span><i class="fa fa-shopping-cart f-s-40 color-success"></i></span>
                </div>
                <div class="media-body media-text-right">
                    <h2><?= $qty ?></h2>
                    <p class="m-b-0">Sales</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-30">
            <div class="media">
                <div class="media-left meida media-middle">
                    <span><i class="fa fa-archive f-s-40 color-warning"></i></span>
                </div>
                <div class="media-body media-text-right">
                    <h2><?= $products ?></h2>
                    <p class="m-b-0">Products</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-30">
            <div class="media">
                <div class="media-left meida media-middle">
                    <span><i class="fa fa-user f-s-40 color-danger"></i></span>
                </div>
                <div class="media-body media-text-right">
                    <h2><?= $users ?></h2>
                    <p class="m-b-0">Customer</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-title">
                <h4>Recent Orders </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>№ Order</th>
                            <th>Phone</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Address</th>

                            <th>Payment type</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td><a href="<?= Url::to(['orders/view','id' => $order->id]) ?>"> <?= $order->id; ?> </a></td>
                                <td><?= $order->phone; ?></td>
                                <td><span><?= number_format($order->amount, '0',' ',' '); ?> сум</span></td>
                                <td><span><?= date('M d, Y',$order->created_at); ?></span></td>
                                <td><span><?= $order->street; ?></span></td>
                                <td><span><?= isset($order->payment->name) ? $order->payment->name : '' ?></span></td>

                                <td><?php if($order->state == 0): ?>
                                        <span class="badge badge-warning">PENDING</span>
                                    <?php else: ?>
                                        <span class="badge badge-success">DONE</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>





<!-- End PAge Content -->