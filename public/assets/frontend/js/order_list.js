/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function autocomplete(inp, arr) {
    var currentFocus;
    inp.addEventListener("input", function (e) {
        var a, b, i, val = this.value;
        closeAllLists();
        if (!val) {
            return false;
        }
        currentFocus = -1;
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        this.parentNode.appendChild(a);
        for (i = 0; i < arr.length; i++) {
            if (arr[i].toUpperCase().includes(val.toUpperCase())) {
                b = document.createElement("DIV");
                b.innerHTML = arr[i]
                b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                b.addEventListener("click", function (e) {
                    inp.value = this.getElementsByTagName("input")[0].value;
                    closeAllLists();
                });
                a.appendChild(b);
            }
        }
    });
    inp.addEventListener("keydown", function (e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x)
            x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
            currentFocus++;
            addActive(x);
        } else if (e.keyCode == 38) {
            currentFocus--;
            addActive(x);
        } else if (e.keyCode == 13) {
            e.preventDefault();
            if (currentFocus > -1) {
                if (x)
                    x[currentFocus].click();
            }
        }
    });
    function addActive(x) {
        if (!x)
            return false;
        removeActive(x);
        if (currentFocus >= x.length)
            currentFocus = 0;
        if (currentFocus < 0)
            currentFocus = (x.length - 1);
        x[currentFocus].classList.add("autocomplete-active");
    }
    function removeActive(x) {
        for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
    }
    function closeAllLists(elmnt) {
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }
    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
}

$.ajax({
    url: '/api/getExportStockInfo',
    method: 'POST',
    success: function (response) {
        autocomplete(document.getElementById("supplier_order"), response.data.suppliers);
        autocomplete(document.getElementById("contract_delivery_1"), response.data.contracts);
        autocomplete(document.getElementById("staff_id"), response.data.staff);
    }
});
$.ajax({
    url: '/api/getShippingNContract',
    method: 'POST',
    success: function (response) {
        autocomplete(document.getElementById("shipping"), response.data.shippings);
        autocomplete(document.getElementById("contract_delivery"), response.data.contracts);
    }
});
$('[data-action="view_process"]').click(function () {
    var process = $(this).parents('tr').next();
    if (process.hasClass('d-none')) {
        process.removeClass('d-none');
        $(this).html('Ẩn');
    } else {
        process.addClass('d-none');
        $(this).html('Hiển thị');
    }

})
function formatDate(date) {
    newdate = date.split('/');
    return newdate[1] + '/' + newdate[0] + '/' + newdate[2];
}
$('#expired').keyup(function () {
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
    $('#expired_date_supplier').val(someFormattedDate);
    $('[name="expired_date_supplier_submit"]').attr('value', dbDate);
})
$('.select').select2();
$('#supplier').change(function () {
    $.ajax({
        url: '/api/getRepresenterBySupplier',
        data: {supplier_id: $(this).val()},
        method: 'POST',
        success: function (response) {
            $('#supplier_representer').html(response.html);
            $('#fax').val(response.fax);
            $('.select').select2();
        }
    });
})

$('.export-stock-view').click(function () {
    var id = $(this).data('id');
    $.ajax({
        url: '/api/export-stock-view',
        method: 'POST',
        data: {id: id},
        success: function (response) {
            if (response.error == false) {
                $('.export_stock').html(response.html);
                $('#export-stock-view').modal('show')
            }
        }
    });
});
$('body').delegate('.warehouse','click', function () {
    if ($('input[name="order_id"]:checked').val() === undefined) {
        swal('Cần chọn hóa đơn trước khi thao tác');
    } else {
        $('#warehoue_order').val($('input[name="order_id"]:checked').val());
        var id = $('input[name="order_id"]:checked').val();
        $.ajax({
            url: '/api/export-stock-view',
            method: 'POST',
            data: {id: id},
            success: function (response) {
                if (response.error == false) {
                    $('.export_stock').html(response.html);
                    $('#export-stock-view').modal('show')
                }
            }
        });
    }
});
$('.btn_bill').click(function(){
    $('.envelope_order_id').val($(this).data('id'));
    $('#frmExportBill').modal('show');
});
$(window).on('scroll', function(event) {
    var scrollValue = $(window).scrollTop();
    if (scrollValue >= 50) {
        $('.card_option').addClass('fixed-top');
    }
    else {
        $('.card_option').removeClass('fixed-top');
    }
});
