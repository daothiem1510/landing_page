/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$('[name="debt"]').change(function () {
    if ($('[name="debt"]:checked').length > 0) {
        $('[name="debt_order_id"]').removeAttr('disabled');
    } else {
        $('[name="debt_order_id"]').attr('disabled', 'true');
    }
})
$('body').delegate('.btn_copy', 'click', function () {
    product_id = $(this).parents('.item').find('.product_id').val();
    supplier_id = $(this).parents('.item').find('.supplier_id').val();
    category_id = $(this).parents('.item').find('.category_id').val();
    export_place = $(this).parents('.item').find('.export_place').val();
    $.ajax({
        url: "/api/copyProduct",
        method: "POST",
        data: {product_id: product_id, supplier_id: supplier_id, category_id: category_id},
        success: function (response) {
            if (response.error == false) {
                $('.product').append(`
                        <div class="row border-bottom-1 border-top-1 mb-3 pt-3 item" >
                            <div class="form-group col-md-2">
                                <label class="required">Sản phẩm</label>
                                <select name="product_id[]" data-placeholder="Chọn danh mục sản phẩm" class="product_id form-control select" data-fouc>
                                    ` + response.product_options + `
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label class="required">Loại hàng</label>
                                <select name="category_id[]" disabled="" data-placeholder="Chọn loại hàng" class="category_id form-control select" data-fouc>
                                    ` + response.category_options + `
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="required">Nhà máy</label>
                                <select name="supplier_id[]" data-placeholder="Chọn nhà máy" class="supplier_id form-control select" data-fouc>
                                    ` + response.supplier_options + `
                                </select>
                            </div>
                            <div class="form-group col-md-1">
                                <label class="required">ĐVT</label>
                                <input name="unit[]" type="text" value="kg" class="form-control">
                            </div>
                            <div class="form-group col-md-1">
                                <label class="required">Số bó</label>
                                <input name="number_sb[]" type="number" class="form-control number_sb">
                            </div>
                            <div class="form-group col-md-1">
                                <label class="required">Số cây</label>
                                <input name="quantity[]" type="number" class="form-control quantity" >
                            </div>
                            <div class="form-group col-md-1">
                                <label class="required">Khối lượng</label>
                                 <input id="out_weight[]" onkeyup="formatValue(this)" type="text" class="form-control out_weight" value="">
                                <input type="hidden" name="out_weight[]" value="" class="form-control weight">
                            </div>
                            <div class="form-group col-md-2">
                                <label class="required">Giá mua</label>
                                <input name="in_price[]" type="number" class="form-control in_price">
                            </div>
                            <div class="form-group col-md-2">
                                <label class="required">Giá bán</label>
                                <input id="out_price[]" type="text" class="form-control out_price_format" onkeyup="formatValue(this)">
                                <input name="out_price[]" type="hidden" class="form-control out_price">
                            </div>
                            <div class="form-group col-md-3">
                                <label class="required">Nơi xuất</label>
                                <input name="export_place[]" value="` + export_place + `" type="text" class="form-control export_place">
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-primary btn-primary btn_copy" style="margin-top:27px;">Copy </button>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-primary btn-danger btn_delete" style="margin-top:27px;">Xóa </button>
                            </div>
                        </div>
                    `);
            }
            $('.select').select2();
        }
    })
});
function formatDate(date) {
    newdate = date.split('/');
    return newdate[1] + '/' + newdate[0] + '/' + newdate[2];
}
$('#expired').change(function () {
    var newdate = new Date(formatDate($('input[name="delivery_date"]').val()));
    console.log(newdate);
    var days = parseInt($(this).val());
    if (days > 0) {
        newdate.setDate(newdate.getDate() + days);
    }
    var dd = newdate.getDate();
    var mm = newdate.getMonth() + 1;
    var yy = newdate.getFullYear();
    var someFormattedDate = dd + '/' + mm + '/' + yy;
    var dbDate = yy + '-' + mm + '-' + dd;
    $('#expired_date').val(someFormattedDate);
    $('[name="expired_date_submit"]').attr('value', dbDate);
})
$('#frmOrder').submit(function () {
    $('.validate').parent().find('.help-block').remove();
    // $('.validate .help-block').remove();
    var empty = false;
    $('.validate').each(function(index){
        if ($(this).val() == '') {
            $(this).parents('.item').find('.accessory_name').focus();
            var span = "<span class='help-block text-danger'>Xin hãy điền đầy đủ thông tin</span>";
            $(this).parent().append(span);
            empty = true;
            return false;
        }
    })
    if (empty) return false;
    return true;
})
$('[data-action="save-order"]').click(function (e) {
    e.preventDefault();
    var elm = this;
    Swal({
        text: "Vui lòng kiểm tra lại số liệu đã nhập trùng khớp với đơn đặt hàng của khách hàng!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Lưu lại',
        cancelButtonText: 'Kiểm tra',
    }).then((result) => {
        if (result.value) {
            $('#frmOrder').submit();
        }
    })
})

$('body').delegate('.quantity_format, .price_format', 'change', function () {
    var quantity =  $(this).parents('.item').find('.quantity').val();
    var price =  $(this).parents('.item').find('.price').val();
    $(this).parents('.item').find('.into_money_format').val((quantity*price).toLocaleString());
    $(this).parents('.item').find('.into_money').val(quantity*price);
    totalMoney();
})

function totalMoney(){
    var total = 0;
    $('.price').each(function(){
        console.log($(this).val());
        if($(this).val() != '' && $(this).parent().parent().find('.quantity').val() != ''){
            total += parseInt($(this).val()) * parseInt($(this).parent().parent().find('.quantity').val());
        }
    })
    $('.total').html(formatNumber(total));
}

