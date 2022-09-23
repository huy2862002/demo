$(function () {
    $("input[name = 'name']").on('keyup', function () {
        if ($(this).val().trim() != '') {
            let error = ``;
            $('#error_name').html(error);
        }
    })

    $("input[name = 'price']").on('keyup', function () {
        if ($(this).val().trim() != '') {
            if ($(this).val() > 0) {
                let error = ``;
                $('#error_price').html(error);
            } else {
                let error = `Cần nhập giá phù hợp`;
                $('#error_price').html(error);
            }
        }
    })

    $("input[name = 'price_discount']").on('keyup', function () {
        if ($(this).val().trim() != '') {
            if ($(this).val() > 0) {
                let error = ``;
                $('#error_price_discount').html(error);
            } else {
                let error = `Cần nhập giá phù hợp`;
                $('#error_price_discount').html(error);
            }
        }
    })

    $("input[name = 'inventory']").on('keyup', function () {
        if ($(this).val().trim() != '') {
            if ($(this).val() >= 0) {
                let error = ``;
                $('#error_inventory').html(error);
            } else {
                let error = `Cần nhập giá phù hợp`;
                $('#error_inventory').html(error);
            }
        }
    })

    $("input[name = 'image']").on('change', function () {
        if ($(this).val() != '') {
            let error = ``;
            $('#error_image').html(error);
        }
    })
    $("input[name = 'short_description']").on('keyup', function () {
        if ($(this).val().trim() != 0) {
            let error = ``;
            $('#error_mtn').html(error);
        }
    })
    $("textarea[name = 'product_description']").on('keyup', function () {
        if ($(this).val().trim() != 0) {
            let error = ``;
            $('#error_mtsp').html(error);
        }
    })

    if ($("select[name = 'category_id']").val() != null) {
        let error = ``;
        $('#error_category').html(error);
        check = false;
    }
    $('#submit_product').on('click', function () {
        let check = true;
        if ($("input[name = 'name']").val().trim() == '') {
            let error = `Vui lòng nhập tên sản phẩm`;
            $('#error_name').html(error);
            check = false;
        }

        if ($("input[name = 'image']").val() == '') {
            let error = `Vui lòng chọn ảnh`;
            $('#error_image').html(error);
            check = false;
        }
        if ($("input[name = 'price']").val().trim() == '') {
            let error = `Vui lòng nhập giá`;
            $('#error_price').html(error);
            check = false;
        }
        if ($("input[name = 'price_discount']").val().trim() == '') {
            let error = `Vui lòng nhập giá ưu đãi`;
            $('#error_price_discount').html(error);
            check = false;
        }
        if ($("input[name = 'inventory']").val().trim() == '') {
            let error = `Vui lòng nhập số lượng tồn kho`;
            $('#error_inventory').html(error);
            check = false;
        }
        if ($("input[name = 'short_description']").val().trim() == '') {
            let error = `Vui lòng nhập mô tả ngắn`;
            $('#error_mtn').html(error);
            check = false;
        }
        if ($("textarea[name = 'product_description']").val().trim() == '') {
            let error = `Vui lòng nhập mô tả sản phẩm`;
            $('#error_mtsp').html(error);
            check = false;
        }
        if ($("select[name = 'category_id']").val() == null) {
            let error = `Vui lòng thêm danh mục trước khi thêm sản phẩm`;
            $('#error_category').html(error);
            check = false;
        }
        if (check == false) {
            let error = `<div style="border: 1px solid #f64848; background-color: #f64848;margin-bottom: 12px; color: white; text-align: center; padding: 6px">
        <b>Error !</b>
    </div>`
            $('#status_form').html(error);
            window.scrollTo(0, 0);
        }
        return check;
    });
})
