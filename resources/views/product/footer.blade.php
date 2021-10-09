<script>
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

        $('.searchProd').keypress(function(e) {
            if(e.which == 13){
                ajax_call();
            }
        });
        $('.color_check').on('click', function(){
            ajax_call();
        });
        $('#ex2').change(function(){
            ajax_call();
        });

        //products-ajax-script
        $('.add_cart').click(function(){
            var product_id = $(this).attr('data-id');
            var color = $('input[name="color"]:checked').val();
            var size = $('input[name="size"]:checked').val();
            if(!size)
            {
                alert("Plese select size");
                return false;
            }
            if(!color)
            {
                alert("Plese select color");
                return false;
            }
            var dataString = 'product_id=' + product_id + '&color=' + color + '&size=' + size;
            $.ajax({
            url: "{{ url('/addToCart') }}",
            type: "get",
            data: dataString,
            success:function(data){

                if(data == "success"){
                    $("#myModal").modal("toggle");
                    cart_count();
                } else {
                    alert("Failed! Try Again.");
                     cart_count();
                }
            }
        });

        });

        $('.wishlist_add').click(function(){
            var product_id = $(this).attr('data-id');
            var dataString = "product_id=" + product_id;
            var url = "{{ url('/add_wishlist') }}";
            //alert(product_id);
            $.ajax({
                url: url,
                type: "get",
                data: dataString,
                success:function(data){

                    if(data == "success"){
                        alert("Successfully Added!");
                        ajax_call();
                    } else {
                        alert("Failed!");
                        ajax_call();
                    }
                }
            });

        });

        $('.wishlist_remove').click(function(){
            var product_id = $(this).attr('data-id');
            var dataString = "product_id=" + product_id;
            var url = "{{ url('/remove_wishlist') }}";
            //alert(product_id);

            $.ajax({
                url: url,
                type: "get",
                data: dataString,
                success:function(data){

                    if(data == "success"){
                        alert("Successfully Removed!");
                        location.reload();
                    } else {
                        alert("Failed!");
                        location.reload();
                    }
                }
            });

        });



        });

</script>
