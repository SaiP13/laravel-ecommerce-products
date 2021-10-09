

<div class="row" style="margin-left: -100px">
    @foreach($products as $row)

            <div class="card">

                @if(\Helper::check_wishlist($row->id))
                    <i class="fa fa-heart wishlist_remove" id="wishlist_remove" data-id="{{$row->id}}" style="color:rgb(240, 12, 12)" ></i>
                @else
                    <i class="fa fa-heart wishlist_add" id="wishlist_add" data-id="{{$row->id}}" style="color:grey" ></i>
                @endif
                <img class="card-img-top" src="{{ url('images/',$row->prod_img)}}">

                <div class="card-body">
                    <h5><b>{{ $row->name}}</b> </h5>
                    <p>{{ $row->description}}</p>
                    <div class="d-flex flex-row my-2">
                        <div class="text-muted">₹ {{ $row->price }}</div>
                    </div>
                    <div class="d-flex flex-row">
                        <p>Sizes : </p>&nbsp;
                        @php $sizes = explode(',',$row->sizes) @endphp
                        @foreach($sizes as $r)
                            <label class="radio"> <input type="radio" name="size" data-id="{{$row->id}}" id="size_value" size-id="{{ $r }}" value="{{ $r }}"> <span>{{ $r }}</span> </label>&nbsp;
                        @endforeach


                    </div>
                    <div class="d-flex flex-row">
                        <p>Colors : </p>&nbsp;
                        @php $colors = DB::table('colors')->where('product_id',$row->id)->get(); @endphp
                        @foreach($colors as $r)
                           <label class="radio"> <input type="radio" name="color" id="color_value" data-id="{{$row->id}}"  value="{{ strtolower($r->color) }}"> <span>{{ ucfirst($r->color) }}</span> </label>&nbsp;
                        @endforeach
                    </div>
                    <a href="{{ url('product-view',$row->id)}}"><button class="btn w-100 btn-primary">View</button></a>&nbsp;
                    <button class="btn w-100 btn-success add_cart" id="add_cart" data-id="{{$row->id}}">Add to Cart</button>

                    <div class="modal" id="myModal">
                        <div class="modal-dialog">
                          <div class="modal-content">

                                <div class="modal-header">
                                <h4 class="modal-title">Success</h4>

                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    Product Successfully added into cart!
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="exampleModal" >
                        <div class="modal-dialog">
                            <div class="modal-content p-5">

                                <div class="modal-body">
                                    <h3 class="mb-5 title">Please Loign</h3>
                                    <hr>
                                    <div class="form-group">
                                        <input type="text" id="email" class="form-control" placeholder="Email *" required >
                                    </div>
                                    <div class="form-group">
                                        <input type="text" id="password" class="form-control" placeholder="password *" required >
                                    </div>
                                    <hr>
                                    <div class="form-group d-flex justify-content-center">
                                        <button class="btn btn-danger" data-dismiss="modal">
                                            Cancel
                                        </button> &nbsp;
                                        <button id="login-submit" class="btn btn-success">
                                            Login
                                        </button>

                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

    @endforeach
    {{-- @if($products->links() != "")
        <div> {{ $products->links()}}</div>
    @endif --}}
</div>

<script>


        $('.add_cart').click(function() {
            var product_id = $(this).attr('data-id');
            var color = $('input[name="color"][data-id='+product_id+']:checked').val();
            var size = $('input[name="size"][data-id='+product_id+']:checked').val();

            if(!size || !color) {
                alert("Plese Select Size & Color");
                return false;
            }

            var dataString = 'product_id=' + product_id + '&color=' + color + '&size=' + size;
            var userid = "{{ session('userid') }}";

            if(userid != ""){
                add_cart();
            } else {
                $("#exampleModal").modal("toggle");
                $('#login-submit').on('click',function(){
                    var email = $('#email').val();
                    var password = $('#password').val();

                    $.ajax({
                        url: "{{ url('ajax-login')}}",
                        type: "get",
                        data: { 'email':email,'password':password},

                        success: function(res){
                            if(res == 'success'){
                                $("#exampleModal").modal('hide');
                                add_cart();
                            } else {
                                alert("Login Failed");
                                $("#exampleModal").modal('hide');
                            }
                        }
                });

                });
            }
            function add_cart(){
                $.ajax({
                    url: "{{ url('/addToCart') }}",
                    type: "get",
                    data: dataString,
                    success:function(data){

                        if(data == "success"){
                            $("#myModal").modal("toggle");
                            config.cart_count();
                        } else {
                            alert("Failed! Try Again.");
                            config.cart_count();
                        }
                    }
                });
            }

        });

        $('.wishlist_add').click(function() {

            var product_id = $(this).attr('data-id');
            var userid = "{{ session('userid') }}";
            var dataString = "product_id=" + product_id;

            if(userid != ""){
               add_wishlist();
            }
            else {
                $("#exampleModal").modal("toggle");

                $('#login-submit').on('click',function(){
                    var email = $('#email').val();
                    var password = $('#password').val();
                    $.ajax({
                        url: "{{ url('ajax-login')}}",
                        type: "get",
                        data: { 'email':email,'password':password},

                        success: function(res){
                            if(res == 'success'){
                                $("#exampleModal").modal('hide');
                                add_wishlist();
                            } else {
                                alert("Login Failed");
                                $("#exampleModal").modal('hide');
                            }
                        }
                    });
                });

            }

            function add_wishlist(){
                $.ajax({
                    url: "{{ url('/add_wishlist') }}",
                    type: "get",
                    data: dataString,
                    success:function(data){

                        if(data == "success"){
                            alert("Successfully Added Into Your Wishlist!");
                            config.products();
                        } else {
                            alert("Failed!");
                            config.products();
                        }
                    }
                });
            }
        });
        $('.wishlist_remove').click(function() {
            var product_id = $(this).attr('data-id');
            var dataString = "product_id=" + product_id;
            var url = "{{ url('/remove_wishlist') }}";


            $.ajax({
                url: url,
                type: "get",
                data: dataString,
                success:function(data){

                    if(data == "success"){
                        alert("Successfully Removed!");
                        config.products();
                    } else {
                        alert("Failed!");
                        config.products();
                    }
                }
            });
        });


</script>



