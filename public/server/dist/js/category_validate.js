
$(function (){
    $('#submit_cate').on('click', function (){
        let check = true;
        if($("input[name = 'name']").val().trim() == ''){
            let error = `Vui lòng nhập tên danh mục`;
            $('#error_name').html(error);
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
    })
})
