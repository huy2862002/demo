$(function () {
    $("input[name = 'label_add']").on('keyup', function () {
        if ($(this).val().trim() != '') {
            $(this).css('border', '1px solid green');
        } else {
            $(this).css('border', '1px solid red');
        }
    })
    $("input[name = 'value_text']").on('keyup', function () {
        if ($(this).val().trim() != '') {
            $(this).css('border', '1px solid green');
        } else {
            $(this).css('border', '1px solid red');
        }
    })
    $("input[name = 'value_image']").on('change', function (e) {
        e.preventDefault();
        if ($(this).val() != '') {
            $(this).css('border', '1px solid green');
            var input = e.target;
            var reader = new FileReader();
            reader.onload = function () {
                var dataURL = reader.result;
                var output = $('#review_image').attr('src', dataURL);
            }
            reader.readAsDataURL(input.files[0]);
        }
    })
    $("input[name = 'value_color']").on('change', function (e) {
        e.preventDefault();
        let value = $(this).val();
        $('#review_color').css('background-color', value);
    })

    $('.add_att').on('click', function () {
        let check = true;
        if ($("input[name = 'label_add']").val().trim() == '') {
            $("input[name = 'label_add']").css('border', '1px solid red');
            check = false;
        }
        if ($("input[name = 'value_image']") && $("input[name = 'value_image']").val() == '') {
            $("input[name = 'value_image']").css('border', '1px solid red');
            check = false;
        }
        if ($("input[name = 'value_text']") && $("input[name = 'value_text']").val() == '') {
            $("input[name = 'value_text']").css('border', '1px solid red');
            check = false;
        }
        if (check == true) {
            let success = `<div style="border: 1px solid #27d11d; background-color: #27d11d;margin-bottom: 12px; color: white; text-align: center; padding: 6px">
        <b>Add Successfully !</b>
    </div>`
            $('#status_form').html(success);
            $('#sbmt').trigger('click');
            check = true;
        } else {
            let error = `<div style="border: 1px solid #f64848; background-color: #f64848;margin-bottom: 12px; color: white; text-align: center; padding: 6px">
        <b>Error !</b>
    </div>`
            $('#status_form').html(error);
            window.scrollTo(0, 0);
        }
        return check;
        ;
    })

});
