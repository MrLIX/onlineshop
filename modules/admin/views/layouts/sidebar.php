<?php
/**
 * Created by PhpStorm.
 * User: Farhodjon
 * Date: 10.03.2018
 * Time: 15:17
 */

use app\modules\admin\widgets\Menu;
use yii\helpers\Url;

?>
<div class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <?php
            try {
                echo Menu::widget([
                    'options' => [ 'id' => 'sidebarnav' ],
                    'submenuTemplate' => "\n<ul aria-expanded='false' class='collapse'>\n{items}\n</ul>\n",
                    'badgeClass' => 'label label-rouded label-primary pull-right',
                    'activateParents' => true,
                    'items' => [
                        [
                            'label' => '',
                            'options' => [ 'class' => 'nav-devider' ]
                        ],
                        [
                            'label' => 'Home',
                            'options' => [ 'class' => 'nav-label' ]
                        ],
                        [
                            'label' => 'Dashboard',
                            'url' => ['default/index'],
                            'icon' => '<i class="fa fa-tachometer"></i>',
                        ],
                        [
                            'label' => 'App',
                            'options' => [ 'class' => 'nav-label' ]
                        ],
                        [
                            'label' => 'Home Page',
                            'url' => '#',
                            'icon' => '<i class="fa fa-home"></i>',
                            'items' => [

                                [
                                    'label' => 'Carousel',
                                    'url' => ['carousel/index'],
                                    'icon' => '<i class="fa fa-angle-double-right"></i>',
                                ],
                                [
                                    'label' => 'Advantages',
                                    'url' => ['services/index'],
                                    'icon' => '<i class="fa fa-angle-double-right"></i>',
                                ],
                                [
                                    'label' => 'Partners',
                                    'url' => ['partners/index'],
                                    'icon' => '<i class="fa fa-angle-double-right"></i>',
                                ],
                                [
                                    'label' => 'Applications',
                                    'url' => ['application/index'],
                                    'icon' => '<i class="fa fa-angle-double-right"></i>',
                                ],

                                [
                                    'label' => 'Social networks',
                                    'url' => ['socials/index'],
                                    'icon' => '<i class="fa fa-angle-double-right"></i>',
                                ],

                            ]
                        ],
                        [
                            'label' => 'Pages',
                            'url' => '#',
                            'icon' => '<i class="fa fa-file-text-o"></i>',
                            'items' => [
                                [
                                    'label' => 'About',
                                    'url' => Url::to(['about/view', 'id'=>1]),
                                    'icon' => '<i class="fa fa-angle-double-right"></i>',
                                ],
                                [
                                    'label' => 'Delivery',
                                    'url' => Url::to(['about/view', 'id'=>2]),
                                    'icon' => '<i class="fa fa-angle-double-right"></i>',
                                ],
                                [
                                    'label' => 'Contacts',
                                    'url' => Url::to(['contacts/view', 'id'=>1]),
                                    'icon' => '<i class="fa fa-angle-double-right"></i>',
                                ],
                            ]
                        ],
                        [
                            'label' => 'Our Services',
                            'url' => '#',
                            'icon' => '<i class="fa  fa-cog"></i>',
                            'items' => [
                                [
                                    'label' => 'Page Our Services',
                                    'url' => Url::to(['our-service/view', 'id'=>1]),
                                    'icon' => '<i class="fa fa-angle-double-right"></i>',
                                ],
                                [
                                    'label' => 'Services',
                                    'url' => Url::to(['our-services/index']),
                                    'icon' => '<i class="fa fa-angle-double-right"></i>',
                                ],
                            ]
                        ],
                        [
                            'label' => 'Products',
                            'url' => '#',
                            'icon' => '<i class="fa fa-asterisk"></i>',
                            'items' => [
                                [
                                    'label' => 'Category',
                                    'url' => Url::to(['category/index']),
                                    'icon' => '<i class="fa fa-angle-double-right"></i>',
                                ],
                                [
                                    'label' => 'Sub Category',
                                    'url' => Url::to(['sub-category/index']),
                                    'icon' => '<i class="fa fa-angle-double-right"></i>',
                                ],
                                [
                                    'label' => 'Products',
                                    'url' => Url::to(['products/index']),
                                    'icon' => '<i class="fa fa-angle-double-right"></i>',
                                ],
                                [
                                    'label' => 'Filters',
                                    'options' => [ 'class' => 'nav-label' ]
                                ],
                                [
                                    'label' => 'Colors',
                                    'url' => Url::to(['colors/index']),
                                    'icon' => '<i class="fa fa-angle-double-right"></i>',
                                ],
                                [
                                    'label' => 'Types',
                                    'url' => Url::to(['types/index']),
                                    'icon' => '<i class="fa fa-angle-double-right"></i>',
                                ],
                            ]
                        ],
                        [
                            'label' => 'Orders',
                            'url' => '#',
                            'icon' => '<i class="fa fa-reorder"></i>',
                            'items' => [
                                [
                                    'label' => 'Orders',
                                    'url' => Url::to(['orders/index']),
                                    'icon' => '<i class="fa fa-angle-double-right"></i>',
                                ],
                                [
                                    'label' => 'Order Products',
                                    'url' => Url::to(['order-products/index']),
                                    'icon' => '<i class="fa fa-angle-double-right"></i>',
                                ],
                                [
                                    'label' => 'Regions',
                                    'url' => ['region/index'],
                                    'icon' => '<i class="fa fa-angle-double-right"></i>',
                                ],
                                [
                                    'label' => 'Rayon',
                                    'url' => ['rayon/index'],
                                    'icon' => '<i class="fa fa-angle-double-right"></i>',
                                ],
                                [
                                    'label' => 'Payment Methods',
                                    'url' => ['payment-method/index'],
                                    'icon' => '<i class="fa fa-angle-double-right"></i>',
                                ],
                                [
                                    'label' => 'Delivery Price',
                                    'url' => ['delivery-price/index'],
                                    'icon' => '<i class="fa fa-angle-double-right"></i>',
                                ],

                            ]
                        ],


                    ]
                ]);
            } catch ( Exception $e ) {
            }
            
            ?>
        </nav>
    </div>
</div>
