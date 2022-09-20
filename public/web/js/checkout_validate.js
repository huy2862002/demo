$(function (){
    $('#regionData').on('change', function (){
        if($(this).val() != 0){
            let alert = ``
            $('#error_region').html(alert);
        }else{
            let alert = `
                        Vui lòng chọn vùng miền
                        `
            $('#error_region').html(alert);
        }
    })
    $('#provinceData').on('change', function (){
        if($(this).val() != 0){
            let alert = ``
            $('#error_province').html(alert);
        }else{
            let alert = `
                        Vui lòng chọn tỉnh / thành phố
                        `
            $('#error_province').html(alert);
        }
    })
    $('#districtData').on('change', function (){
        if($(this).val() != 0){
            let alert = ``
            $('#error_district').html(alert);
        }else{
            let alert = `
                        Vui lòng chọn quận / huyện
                        `
            $('#error_district').html(alert);
        }

    })
    $("input[name = 'user_name']").on('keyup', function (){
        if($(this).val().trim() != ''){
            let alert = ``
            $('#error_user_name').html(alert);
        }else{
            let alert = `
                        Vui lòng nhập họ và tên
                        `
            $('#error_user_name').html(alert);
        }
    })
    $("input[name = 'phone_number']").on('keyup', function (){
        if($(this).val().trim() != ''){
            let alert = ``
            $('#error_phone').html(alert);
        }else{
            let alert = `
                        Vui lòng nhập số điện thoại
                        `
            $('#error_phone').html(alert);
        }
    })
    $("input[name = 'address']").on('keyup', function (){
        if($(this).val().trim() != ''){
            let alert = ``
            $('#error_address').html(alert);
        }else{
            let alert = `
                        Vui lòng nhập địa chỉ của bạn
                        `
            $('#error_address').html(alert);
        }
    })
    $("input[name = 'email']").on('keyup', function (){
        if($(this).val().trim() != ''){
                let alert = ``
                $('#error_email').html(alert);
        }else{
            let alert = `
                        Vui lòng nhập email
                        `
            $('#error_email').html(alert);
        }
    })

    $('#submit_checkout').on('click', function (){
        var check = true;
        if($("input[name = 'user_name']").val().trim() == ''){
            let alert = `
                        Vui lòng nhập họ và tên
                        `
            $('#error_user_name').html(alert);
            check = false;
        }
        if($("input[name = 'phone_number']").val().trim() == ''){
            let alert = `
                        Vui lòng nhập số điện thoại
                        `
            $('#error_phone').html(alert);
            check = false;
        }
        if($("input[name = 'email']").val().trim() == ''){
            let alert = `
                        Vui lòng nhập email
                        `
            $('#error_email').html(alert);
            check = false;
        }
        if($("input[name = 'address']").val() && $("input[name = 'address']").val().trim() == '' || $("input[name = 'address']").val().trim() == ''){
            let alert = `
                        Vui lòng nhập địa chỉ
                        `
            $('#error_address').html(alert);
            check = false;
        }
        if($('#districtData').val() && $('#districtData').val() == 0){
            let alert = `
                        Vui lòng chọn quận / huyện
                        `
            $('#error_district').html(alert);
            check = false;
        }
        if($('#regionData').val() &&$('#regionData').val() == 0){
            let alert = `
                        Vui lòng chọn vùng / miền
                        `
            $('#error_region').html(alert);
            check = false;
        }
        if($('#provinceData').val() && $('#provinceData').val() == 0){
            let alert = `
                        Vui lòng chọn tỉnh / thành phố
                        `
            $('#error_province').html(alert);
            check = false;
        }
        return check;
    })

})
