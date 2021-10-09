@foreach($products as $row)

    <div class="product">
        <div class="product-image">
            <img src="{{ url('images/',$row->prod_img)}}">
        </div>
        <div class="product-details">
            <div class="product-title"><b style="color:red">{{ ucfirst($row->name) }}</b></div>
            <p class="product-description"> {{ ucfirst($row->description)}}</p>
            <p class="product-description"><b>COLOR :</b> {{ ucfirst($row->color)}}</p>
            <p class="product-description"><b>SIZE :</b>  {{ ucfirst($row->size)}}</p>
            </div>
            <div class="product-price">{{$row->price}}</div>
            <div class="product-quantity">
                <input type="number" value="{{$row->quantity}}" min="1" data-id="{{ $row->id}}" >
            </div>
            <div class="product-removal">
            <button class="remove-product" data-id="{{ $row->id}}">
                Remove
            </button>
        </div>
        <div class="product-line-price"> {{ ($row->quantity * $row->price)}}</div>
    </div>

@endforeach
<script>

        recalculateCart();
        var fadeTime = 300;

        $('.product-quantity input').change( function() {
            updateQuantity(this);
            var quantity = $(this).val();
            var id = $(this).attr('data-id');
            var dataString = 'id=' + id + '&quantity=' + quantity;
             //alert(dataString);
            $.ajax({
                url: "{{ url('update-product-quantity') }}",
                type: "get",
                data: dataString,
                success: function(data){
                    if(data != "success"){
                        alert('Quantity update Failed')
                    }
                }

            });
            //alert(quantity);
        });


        $('.remove-product').click( function() {
            var id = $(this).attr('data-id');
            removeItem(this);
            var dataString = "id=" + id;

            $.ajax({
                url : "{{ url('remove-cart-item') }}",
                type: "get",
                data: dataString,
                success: function(data){
                    console.log(data);
                    if(data == "success"){
                       alert('successfully removed');
                    } else {
                        alert('failed');
                    }
                }
            });

        });


        /* Recalculate cart */
        function recalculateCart()
        {
            var subtotal = 0;

            /* Sum up row totals */
            $('.product').each(function () {
                subtotal += parseFloat($(this).children('.product-line-price').text());
            });

            /* Calculate totals */

            var total = subtotal;

            /* Update totals display */
            $('.totals-value').fadeOut(fadeTime, function() {

                $('#cart-total').html(total.toFixed(2));
                if(total == 0){
                    $('.checkout').fadeOut(fadeTime);
                }else{
                    $('.checkout').fadeIn(fadeTime);
                }
                    $('.totals-value').fadeIn(fadeTime);
            });
        }


        /* Update quantity */
        function updateQuantity(quantityInput)
        {
        /* Calculate line price */
            var productRow = $(quantityInput).parent().parent();
            var price = parseFloat(productRow.children('.product-price').text());
            var quantity = $(quantityInput).val();
            var linePrice = price * quantity;

            /* Update line price display and recalc cart totals */
            productRow.children('.product-line-price').each(function () {
                $(this).fadeOut(fadeTime, function() {
                $(this).text(linePrice.toFixed(2));
                recalculateCart();
                $(this).fadeIn(fadeTime);
                });
            });
        }

        function removeItem(removeButton)
        {

            var productRow = $(removeButton).parent().parent();
            productRow.slideUp(fadeTime, function() {
                productRow.remove();
                recalculateCart();
            });

        }
</script>
@include('product.footer')
