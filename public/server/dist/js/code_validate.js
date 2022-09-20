$(function () {
            $("input[name = 'code']").on('keyup', function () {
                if ($(this).val().trim() != '') {
                    let error = ``;
                    $('#error_code').html(error);
                }
            })
            $("input[name = 'quantity']").on('keyup', function () {
                if ($(this).val().trim() != '') {
                    if ($(this).val() > 0) {
                        let error = ``;
                        $('#error_qty').html(error);
                    } else {
                        let error = `Cần nhập số lượng phù hợp`;
                        $('#error_qty').html(error);
                    }
                }
            })
            $("input[name = 'discount']").on('keyup', function () {
                if (100 > $(this).val() > 0) {
                    let error = ``;
                    $('#error_dis').html(error);
                } else {
                    let error = `Cần nhập số % phù hợp`;
                    $('#error_dis').html(error);
                }
            })
            $("input[name = 'start']").on('change', function () {
                if ($(this).val() != 0) {
                    let error = ``;
                    $('#error_start').html(error);
                }
            })
            $("input[name = 'end']").on('change', function () {
                if ($(this).val() != 0) {
                    let error = ``;
                    $('#error_end').html(error);
                }
            })
            $('#submit_code').on('click', function () {
                let check = true;
                if ($("input[name = 'code']").val().trim() == '') {
                    let error = `Vui lòng nhập mã code`;
                    $('#error_code').html(error);
                    check = false;
                }
                if ($("input[name = 'quantity']").val().trim() == '') {
                    let error = `Vui lòng nhập số lượng mã code`;
                    $('#error_qty').html(error);
                    check = false;
                }
                if ($("input[name = 'discount']").val().trim() == '') {
                    let error = `Vui lòng nhập mức % giảm giá`;
                    $('#error_dis').html(error);
                    check = false;
                }
                if ($("input[name = 'start']").val() == 0) {
                    let error = `Vui lòng chọn ngày mở code`;
                    $('#error_start').html(error);
                    check = false;
                }
                if ($("input[name = 'end']").val() == 0) {
                    let error = `Vui lòng chọn ngày đóng hạn`;
                    $('#error_end').html(error);
                    check = false;
                }
                return check;
            });
        })
