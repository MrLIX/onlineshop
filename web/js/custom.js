/* Mobile Menu
============================================================*/
$(document).on('click', '.nav_menu_btn, .nav_menu_bg', function () {
    $('.nav_menu_btn').toggleClass('active');
    $('.nav_menu').toggleClass('active');
    $('.nav_menu_bg').toggleClass('active');
    $('html, body').toggleClass('ov-h');
});
/*========== Mobile Menu ==========*/

//LOADing
function runLoader() {
    $('.loader').removeClass('hidden');
}

function stopLoader() {
    $('.loader').addClass('hidden');
}

//=========================================


/* Product Filter [Sub Category]
============================================================ */

// Filter for Category
$('#filter-category').submit(function (e) {
    e.preventDefault();
    var form = $(this);
    $.ajax({
        url: form.attr('action'),  // Url::to(['/product/filter-ajax'])
        type: form.attr('method'), // GET
        data: form.serialize(),    // ID, NEWS, TYPES, COLORS
        beforeSend: function () {
            runLoader();
        },
        success: function (res) {
            // alert(form.serialize());
            $('#pord').html(res);  // view('products-ajax')
            //window.history.pushState({}, "", res.url);
        },
        complete: function () {
            stopLoader();
        }

    });

});
/*========== End Filter Products ==========*/


/* Add Product to Favorites
============================================================ */
$(document).on('click', '.add-favorites', function (e) {
    e.preventDefault();
    var fav = $(this);
    var product_id = fav.data('id');
    var url = fav.data('url');

    $.ajax({
        url: url,
        data: {product_id: product_id},
        type: 'get',
        beforeSend: function () {
            runLoader();
        },
        success: function (res) {
            fav.removeClass('add-favorites');
            fav.addClass('del-favorites');
            $('.count-favorites').html(res);  // Изменяем количество favorites header
        },
        error: function () {
            alert('Ошибка при добавлении в избренные');
        },
        complete: function () {
            stopLoader();
        }

    });
});
/*========== END ADD to Favorites ==========*/

/* Add Product to Favorites - Page Product
// its for to add product, not delete
============================================================ */
$(document).on('click', '.add-to-favorites', function (e) {
    e.preventDefault();
    var fav = $(this);
    var product_id = fav.data('id');
    var url = fav.data('url');

    $.ajax({
        url: url,
        data: {product_id: product_id},
        type: 'get',
        beforeSend: function () {
            runLoader();
        },
        success: function (res) {
            if(res == '-1'){
                swal({
                    title: 'Вы уже добавили этот продукт в избранные',
                    text: "",
                    icon: "success",
                    button: "OK"
                });
            } else{
              $('.count-favorites').html(res);  // Изменяем количество favorites header
            }
        },
        error: function () {
            alert('Ошибка при добавлении в избренные');
        },
        complete: function () {
            stopLoader();
        }

    });
});
/*========== END ADD to Favorites ==========*/

/* Delete Product from Favorites
============================================================ */
$(document).on('click', '.del-favorites', function (e) {
    e.preventDefault();

    var fav = $(this);
    var product_id = fav.data('id');
    var url = fav.data('url-del');

    $.ajax({
        url: url,
        data: {product_id: product_id},
        type: 'get',
        beforeSend: function () {
            runLoader();
        },
        success: function (res) {
            fav.removeClass('del-favorites');
            fav.addClass('add-favorites');
            $('.count-favorites').html(res);  // Изменяем количество favorites header
        },
        error: function () {
            alert('Ошибка при удалении');
        },
        complete: function () {
            stopLoader();
        }

    });


});

/*========== END Delete Product from Favorites ==========*/


/* ADD Product to $_SESSION['cart']
============================================================*/

$(document).on('click', '.add-to-cart', function (e) {
    e.preventDefault()
    var form = $('#add-to-cart');
    form.submit();
});

$('#add-to-cart').submit(function (e) {
    e.preventDefault();
    var form = $(this);
    $.ajax({
        url: form.attr('action'),  // Url::to(['/product/add-to-cart'])
        type: form.attr('method'), // GET
        data: form.serialize(),    // ID_prod, Color, TYPES, Count
        beforeSend: function () {
            runLoader();
        },
        success: function (res) {
            var swal_a = $("#swal1").val();
            $('.count_cart').html(res);
            swal({
                title: swal_a,
                text: "",
                icon: "success",
                button: "OK",
            });
        },
        complete: function () {
            stopLoader();
        }

    });


});


/*========== END add to cart ==========*/


/* Delete product from SESSION ['cart']
============================================================*/

$(document).on('click', '.del-from-cart', function () {

    var id = $(this).data('id');
    var color = $(this).data('color');
    var type = $(this).data('type');
    var url = $(this).data('url');
    $.ajax({
        url: url,
        data: {id: id, color: color, type: type},
        type: 'GET',
        beforeSend: function () {
            runLoader();
        },
        success: function () {

            location.reload();
        },
        error: function () {
            alert('Ошибка');
        },
        complete: function () {
            stopLoader();
        }
    })
});

/*========== END delete product from cart ==========*/


/* Change product qty from SESSION ['cart']
============================================================*/
$(document).on('change', '.change-prod-qty', function (e) {
    e.preventDefault();
    var select = $(this);
    var value = select.val();
    var url = select.data('url');
    var id = select.data('id');
    var color = select.data('color');
    var type = select.data('type');

    $.ajax({
        url: url,
        data: {id: id, value: value, color: color, type: type},
        type: 'GET',
        beforeSend: function () {
            runLoader();
        },
        success: function (res) {
            //alert(res);
            //$('.count_cart').html(res);
            location.reload();
        },
        error: function () {
            alert('Ошибка');
        },
        complete: function () {
            stopLoader();
        }
    })


});


/*========== END change product qty from cart ==========*/


/* Sign UP
============================================================*/
$(document).on('submit', '#sign-up', function (e) {
    e.preventDefault();
    var data = $(this).serialize();
    var url = $(this).attr('action');
    var type = $(this).attr('method');

    // console.log('salom');
    $.ajax({
        url: url,
        type: type,
        data: data,
        beforeSend: function () {
            runLoader();
        },
        success: function (res) {
            $('.model-reg').html(res);
        },
        error: function () {
            alert('Ошибка');
        },
        complete: function () {
            stopLoader();
        }
    })


});

/*========== END Sign Up ==========*/


/* Check Password and Confirm Password with ID
============================================================*/


var password = document.getElementById("password")
    , confirm_password = document.getElementById("confirm_password");

function validatePassword() {
    if (password.value != confirm_password.value) {
        confirm_password.setCustomValidity("Пароли не совпадают");
    } else {
        confirm_password.setCustomValidity('');
    }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;


/*========== END chekc password ==========*/

/* Get Code Form (url: sign-up-ajax)
============================================================*/
$(document).on('click', '.get-code', function (e) {
   e.preventDefault();
   var phone = $('#phone').val();
   var id = $('#id').val();
    $.ajax({
        url: '/site/get-code',
        type: 'post',
        data: {phone:phone, id:id},
        success: function (res) {
            $('#phone').attr('disabled', true);
            $('[data-code-disabled]').attr('disabled', false).focus();
            $('.fmlz_info_code_txt').addClass('active');
            $('#sms').attr('value',res);

        },
        error: function () {
            alert('Ошибка');
        }
    });

});

$(document).on('submit', '#get-sms', function (e) {
    e.preventDefault();

    var data = $(this).serialize();
    var url = $(this).attr('action');
    var type = $(this).attr('method');
    $.ajax({
        url: url,
        type: type,
        data: data,
        success: function (res) {

            if(res == 2){
                var code = document.getElementById("code")
                code.setCustomValidity("Не правильный код");
            }
        },
        error: function () {
            alert('Ошибка');
        }
    });

});


/*========== END Get code ==========*/



/* Select Region
============================================================*/
$(document).on('change', '.region', function (e) {
    e.preventDefault();
    var region_id = $(this).val();

    $.ajax({
        type: 'GET',
        url: '/site/region',
        data: {region_id: region_id},
        success: function (res) {
            $('.rayon').html(res);


        },
        error: function (e) {
            console.log('error');
        }
    });
});
/*========== END select ==========*/


/* Order Get Code
============================================================*/
$(document).on('click','.order-get-code', function (e) {
   e.preventDefault();
   var phone = $('#phone').val();
    $.ajax({
        type: 'GET',
        url: '/site/order-get-code',
        data: {phone: phone},
        success: function (res) {
            $('#phone').attr('disabled', true);
            $('[data-code-disabled]').attr('disabled', false).focus();
            $('.order-info-btn').removeAttr('disabled');
            $('.fmlz_info_code_txt').addClass('active');
            $('#sms').attr('value', res);
        },
        error: function (e) {
            console.log('error');
        }
    });

});

$(document).on('submit','#order-address', function (e) {
    e.preventDefault();
    var phone = $('#phone').val();
    var name = $('#name').val();
    var code = $('#code').val();
    var sms = $('#sms').val();
    var url = $(this).attr('action');
    var type = $(this).attr('method');

    $.ajax({
        type: type,
        url: url,
        data: {phone:phone, name:name, code:code, sms:sms},
        success: function (res) {
           if(res ==  2){
               swal({
                   title: 'Не правильный код',
                   text: "Проверьте и повторите сново",
                   icon: "error",
                   button: "OK",
               });
           } else{
               window.location.href = res;
           }

        },
        error: function (e) {
            console.log('error');
        }
    });

});

/*========== END Order Get code ==========*/



/* Banner
============================================================*/
$(document).ready(function () {
    try {
        var owl = $('.banner');

        owl.owlCarousel({
            // autoPlay: 7000,
            stopOnHover: true,
            singleItem: true,
            autoHeight: true,
            navigation: false,
            pagination: false,
            slideSpeed: 300,
            paginationSpeed: 400,
            addClassActive: true,
            afterAction: function () {
                $('.banner_bg').removeClass('active').eq(this.owl.currentItem).addClass('active');
            }
        });

        // Custom Navigation Events
        $('.banner_btn.next').click(function () {
            owl.trigger('owl.next');
        });

        $('.banner_btn.prev').click(function () {
            owl.trigger('owl.prev');
        });
    }
    catch (e) {
        console.warn('Owl Carousel cannot find .banner');
    }
});
/*========== Banner ==========*/


/* Partners
============================================================*/
$(document).ready(function () {
    try {
        var owl = $('.partner_bnr');

        owl.owlCarousel({
            // autoPlay : 3000,
            stopOnHover: true,
            navigation: false,
            pagination: true,
            itemsCustom: [
                [0, 2],
                [768, 3],
                [1200, 4]
            ],
            lazyLoad: true
        });
    }
    catch (e) {
        console.warn("Owl Carousel cannot find .partner_bnr");
    }
});
/*========== Partners ==========*/


/* Slice Flower
============================================================*/
$(window).on('load', function () {
    try {
        $('.slice_f_gal').masonry({
            itemSelector: '.slice_f_gal_it',
            percentPosition: true,
        });
    }
    catch (e) {
        console.warn('Masonry cannot find .slice_f_gal');
    }
});
/*========== Slice Flower ==========*/


/* Checkbox
============================================================*/
$(document).on('click', '.reg_pop_chk', function () {
    $(this).toggleClass('active');

    var inputCheck = $(this).siblings('.reg_pop_chk_inp');
    inputCheck.prop('checked', !inputCheck.prop('checked'));
});
/*========== Checkbox ==========*/


/* Registration Popup
============================================================*/
$(document).on('click', '[data-login]', function (e) {
    e.preventDefault();

    $('html, body').animate({scrollTop: 0}, 700);

    $('.hdr_act_user').toggleClass('active');
});

$(document).click(function (e) {
    if ($(e.target).is('.hdr_act_user, .hdr_act_user *, [data-login], [data-login] *') === false) {
        $('.hdr_act_user').removeClass('active');
    }
});
/*========== Registration Popup ==========*/


/* Search Product Check
============================================================*/
$(document).on('click', '.search_p_nav_chk', function () {
    $(this).toggleClass('active');

    var inputCheck = $(this).children('.inp');
    inputCheck.prop('checked', !inputCheck.prop('checked'));
    var form = $('#filter-category');
    form.submit();
});
/*========== Search Product Check ==========*/


/* Search Product Dropdown
============================================================*/
$(document).on('click', '.search_p_nav_opt_ls > li > a', function (e) {
    e.preventDefault();

    $(this).parent().toggleClass('active').siblings().removeClass('active');
});

$(document).click(function (e) {
    if ($(e.target).is('.search_p_nav_opt_ls > li, .search_p_nav_opt_ls > li *') === false) {
        $('.search_p_nav_opt_ls > li').removeClass('active');
    }
});
/*========== Search Product Dropdown ==========*/


/* Search Product Inner Check
============================================================*/
$(document).on('click', '.search_p_nav_drop > li', function () {
    $(this).toggleClass('active');

    var inputCheck = $(this).children('.inp');
    inputCheck.prop('checked', !inputCheck.prop('checked'));
    var form = $('#filter-category');
    form.submit();

    $(this).siblings().removeClass('active').children('.inp').prop('checked', false);


    if ($(this).hasClass('active')) {
        $(this).parent().siblings('a').addClass('active');
    }
    else {
        $(this).parent().siblings('a').removeClass('active');
    }
});
/*========== Search Product Inner Check ==========*/


/* Flower Action
============================================================*/
$(document).on('click', '.flower_act', function () {
    $(this).toggleClass('active');
});
/*========== Flower Action ==========*/


/* Flower Remove
============================================================*/
$(document).on('click', '.flower_close', function () {
    $(this).closest('[data-flower-close]').fadeOut(700, function () {
        $(this).remove();
    });
});
/*========== Flower Remove ==========*/


/* Personal Data Edit
============================================================*/
$(document).on('click', '[data-personal-data]', function (e) {
    e.preventDefault();

    $(this).closest('.psnl_data_it').fadeOut(700, function () {
        $(this).siblings('.psnl_data_it').fadeIn(700);
    });
});
/*========== Personal Data Edit ==========*/


/* Personal Data Tab
============================================================*/
$(document).on('click', '.psnl_data_ls > li', function () {

    $(this).addClass('active').siblings().removeClass('active');

    $('.data_tab_it').eq($(this).index()).addClass('active').siblings().removeClass('active');
});
/*========== Personal Data Tab ==========*/


/* Formalization Info
============================================================*/
// $(document).on('click', '[data-code]', function (e) {
//     e.preventDefault();
//
//     $('[data-code-active]').attr('disabled', true);
//
//     $('[data-code-disabled]').attr('disabled', false).focus();
//
//     $('.fmlz_info_code_txt').addClass('active');
// });
/*========== Formalization Info ==========*/


/* Formalization Pay Type
============================================================*/
$(document).on('click', '.fmlz_pay_type_it', function () {
    $('.fmlz_pay_type_it').removeClass('active').children('.inp').prop('checked', false);

    $(this).addClass('active').children('.inp').prop('checked', true);
});
/*========== Formalization Pay Type ==========*/


/* Product Slider
============================================================*/
try {
    $('.prod_img_bnr').slick({
        asNavFor: '.prod_img_thumb_bnr',
        slidesToShow: 1,
        slidesToScroll: 1,
        adaptiveHeight: true,
        infinite: false,
        arrows: false,
        fade: true
    });


    $('.prod_img_thumb_bnr').slick({
        asNavFor: '.prod_img_bnr',
        slidesToShow: 3,
        slidesToScroll: 1,
        vertical: true,
        verticalSwiping: true,
        infinite: false,
        focusOnSelect: true,
        prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-angle-up"></i></button>',
        nextArrow: '<button type="button" class="slick-next"><i class="fa fa-angle-down"></i></button>',

        responsive: [
            {
                breakpoint: 480,
                settings: {
                    vertical: false,
                    verticalSwiping: false,
                    slidesToShow: 2,
                }
            }
        ]
    });
}
catch (e) {
    console.warn('Slick cannot find .prod_img_bnr, .prod_img_thumb_bnr');
}
/*========== Product Slider ==========*/


/* Product Zoom
============================================================*/
$(document).ready(function () {
    try {
        for (var i = 0; i < $('.xzoom').length; i++) {
            $('.xzoom').eq(i).xzoom({
                tint: '#333',
                Xoffset: 15
            });
        }
    }
    catch (e) {
        console.warn('xZoom cannot find .xzoom');
    }
});
/*========== Product Zoom ==========*/


/* Product Pay Type
============================================================*/
// $(document).on('click', '.prod_pay_it', function () {
// 	$('.prod_pay_it').removeClass('active').children('.inp').prop('checked', false);
//
// 	$(this).addClass('active').children('.inp').prop('checked', true);
// });
/*========== Product Pay Type ==========*/


/* Registration Modal
============================================================*/
$('#RegModal_1').on('hidden.bs.modal', function (e) {
    setTimeout(function () {
        $('#RegModal_2').modal('show');
    }, 500);
});
/*========== Registration Modal ==========*/


/* Password Recovery Modal
============================================================*/
$('#PassRecovery').on('hidden.bs.modal', function (e) {
    setTimeout(function () {
        $('#PassNew').modal('show');
    }, 500);
});
/*========== Password Recovery Modal ==========*/


/* Header
============================================================*/

/*========== Header ==========*/


