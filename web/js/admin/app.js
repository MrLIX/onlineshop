$('.dropify').dropify({
    messages: {
        'default': 'Drag and drop a file here or click',
        'replace': 'Drag and drop or click to replace',
        'remove': 'Remove',
        'error': 'Ooops, something wrong happended.'
    }
});
//LOADing
function runLoader() {
    $('.loader').removeClass('hidden');
}

function stopLoader() {
    $('.loader').addClass('hidden');
}

var tag = $('#admin-content p:first:has("a")');
$('.page-titles .col-md-5.align-self-center').html(tag.html());
tag.remove();

function discount() {
    var val_p = $('#products-price').val();
    var val_d = $('#products-discount').val();
    price = val_p - (val_p * val_d) / 100;
    $('#products-discount_price').val(price);
}

$(document).on('change','#products-category', function (e) {
    e.preventDefault();
    var id = $(this).val();

    $.ajax({
        url: 'select-category',
        type:'post',
        data: {id:id},
        beforeSend: function () {
            runLoader();
        },
        success: function (res) {
            $('#products-category_id').html(res);

        },
        error: function () {
            alert('Error');
        },
        complete: function () {
            stopLoader();
        }
    });

});