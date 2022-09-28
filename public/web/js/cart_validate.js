$(function (){
   function validate_cart(){
       $("#regionData").on('change', function (){
           if($(this).val() != 0){
               let alert = ``
               $('#error_region').html(alert);
           }else{
               let alert = `
                        Enter your region
                        `
               $('#error_region').html(alert);
           }
       })
       $("#provinceData").on('change', function (){
           if($(this).val() != 0){
               let alert = ``
               $('#error_province').html(alert);
           }else{
               let alert = `
                        Enter your province / city
                        `
               $('#error_province').html(alert);
           }
       })
       $("#districtData").on('change', function (){
           if($(this).val() != 0){
               let alert = ``
               $('#error_district').html(alert);
           }else{
               let alert = `
                        Enter your district
                        `
               $('#error_district').html(alert);
           }

       })
       $('#delivery_time').on('change', function (){
           if($(this).val() != 0){
               let alert = ``
               $('#error_delivery').html(alert);
           }else{
               let alert = `
                        Enter your delivery time
                        `
               $('#error_delivery').html(alert);
           }

       })

       $("input[name = 'user_name']").on('keyup', function (){
           if($(this).val().trim() != ''){
               let alert = ``
               $('#error_user_name').html(alert);
           }else{
               let alert = `
                        Enter your full name
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
                        Enter your phone number
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
                        Enter your address
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
                        Enter your email
                        `
               $('#error_email').html(alert);
           }
       })

       $('#submit_cart').on('click', function (){
           var check = true;
           if($("input[name = 'user_name']").val().trim() == ''){
               let alert = `
                        Enter your full name
                        `
               $('#error_user_name').html(alert);
               check = false;
           }
           if($("input[name = 'phone_number']").val().trim() == ''){
               let alert = `
                        Enter your phone number
                        `
               $('#error_phone').html(alert);
               check = false;
           }
           if($("input[name = 'email']") && $("input[name = 'email']").val().trim() == ''){
               let alert = `
                        Enter your email
                        `
               $('#error_email').html(alert);
               check = false;
           }
           if(!$("input[name = 'address_id']").val() && $("input[name = 'address']").val().trim() == ''){
               let alert = `
                        Enter your address
                        `
               $('#error_address').html(alert);
               check = false;
           }
           if($("#districtData").val() && $("#districtData").val() == 0){
               let alert = `
                        Enter your district
                        `
               $('#error_district').html(alert);
               check = false;
           }
           if($("#regionData").val() &&$ ("#regionData").val() == 0){
               let alert = `
                        Enter your region
                        `
               $('#error_region').html(alert);
               check = false;
           }
           if($('#delivery_time').val() &&$('#delivery_time').val() == 0){
               let alert = `
                        Enter your delivery time
                        `
               $('#error_delivery').html(alert);
               check = false;
           }
           if($("#provinceData").val() && $("#provinceData").val() == 0){
               let alert = `
                        Enter your province / city
                        `
               $('#error_province').html(alert);
               check = false;
           }
           return check;
       })
   }
   validate_cart();

})
