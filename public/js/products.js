$(document).ready(function(){

    ajax_call();
    cart_count();

    function ajax_call(){

        var key = $('#search').val();
        var colors = [];
        $('.color_check:checked').each(function(){
            colors.push($(this).val());
        });
        //price
        var p = [];
        var price = $('#ex2').val();
        p = price.split(',');
        var min = p[0];
        var max = p[1];
        $('#min_value').text("Rs: "+min);
        $('#max_value').text("Rs: "+max);
        //end

        var dataString = 'key=' + key + '&colors=' + colors + '&price=' + price;

        $.ajax({
            url: "{{ url('get-products-ajax') }}",
            type: "get",
            data: dataString,
            success:function(data){
                if(data != ""){

                    $("#ajax_result").html(data);
                } else {
                    $("#ajax_result").html("<p>No data Avaliable</p>");
                }
            }
        });

    }
    function cart_count(){
        $.ajax({
            url: "{{ url('get-cart-count') }}",
            type: "get",
            success:function(data){
                if(data){
                    $("#cart_count").text(data.cart_count);
                }
            }
        });
    }

    // $('.searchProd').keypress(function(e) {
    //     if(e.which == 13){
    //         ajax_call();
    //     }
    // });
    $(".searchProd").keyup(function(){
        ajax_call();
    });
    $('.color_check').on('click', function(){
        ajax_call();
    });
    $('#ex2').change(function(){
        ajax_call();
    });

});
