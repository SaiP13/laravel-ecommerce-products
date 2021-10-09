<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<title>Add Products</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
body {
	color: #fff;
	background: #3598dc;
	font-family: 'Roboto', sans-serif;
}
.form-control {
	min-height: 41px;
	box-shadow: none;
	border-color: #e1e4e5;
	font-size: 14px;
}
.form-control, .btn {
	border-radius: 3px;
}
.signup-form {
	width: 400px;
	margin: 0 auto;
	padding: 30px 0;
}
.signup-form form {
	color: #9ba5a8;
	border-radius: 3px;
	margin-bottom: 15px;
	background: #fff;
	box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
	padding: 30px;
}
.signup-form h2 {
	color: #333;
	font-weight: bold;
	margin-top: 0;
}
.signup-form hr {
	margin: 0 -30px 20px;
}
.signup-form .form-group {
	margin-bottom: 20px;
}
.signup-form label {
	font-weight: normal;
	font-size: 13px;
}
.signup-form .btn, .signup-form .btn:active {
	font-size: 16px;
	font-weight: bold;
	background: #5fcaba !important;
	border: none;
	min-width: 140px;
}
.signup-form .btn:hover, .signup-form .btn:focus {
	background: #3fc0ad !important;
}
.signup-form a {
	color: #fff;
	text-decoration: underline;
}
.signup-form a:hover {
	text-decoration: none;
}
.signup-form form a {
	color: #5fcaba;
	text-decoration: none;
}
.signup-form form a:hover {
	text-decoration: underline;
}
</style>
</head>
<body>
<div class="signup-form">
    <form action="{{ isset($product)? url('update-product',$product->id) : url('store-product') }}" method="POST" enctype="multipart/form-data">

        <h4 class="text-center">Add New Product</h4>
        {{ csrf_field() }}
		@if(session('status'))
            <center style="color:green">{{ session('status') }}</center>
        @endif

		<hr>
        <div class="form-group">
        	<label for=''>Product Name </label><input type="text" class="form-control" name="name" value="{{ isset($product) ? $product->name : old('name')}}" placeholder="Product Name" >
        </div>
        <div class="form-group">
        	<label for=''>Product Price ₹  </label><input type="text" class="form-control" name="price" value="{{ isset($product) ? $product->price : old('price')}}" placeholder="Product Price" >
        </div>
        <div class="form-group">
        	<label for=''>Product Discount Price ₹  </label><input type="text" class="form-control" name="discount_price" value="{{ isset($product) ? $product->discount_price : old('discount_price')}}" placeholder="Discount Price" >
        </div>
        <div class="form-group">
        	<label for=''>Product Qunatity </label><input type="text" class="form-control" name="quantity" value="{{ isset($product) ? $product->quantity : old('quantity')}}" placeholder="Product Quntity" >
        </div>

        {{-- <div class="form-group">
        	<input type="text" class="form-control" name="color" value="" placeholder="Product Color" >
        </div> --}}

        {{-- <div class="form-group">
        	<input type="text" class="form-control" name="size" value="" placeholder="Product Size" >
        </div> --}}

        <div class="form-group field_wrapper">
            <div>

                @if(isset($product))
                    <label for=''>Product Colors </label><br>
                    @php $r = explode(',',$product->colors) @endphp
                    @foreach($r as $color)
                        <input type="text" name="color[]" value="{{ $color}}"/>
                    @endforeach
                @else
                    <label for=''>Product Colors </label><br>
                    <input placeholder="Product Color" type="text" name="color[]"/>
                    <a href="javascript:void(0);" class="add_button" title="Add field"><img src="{{ url('assets/add-icon.png') }}"/></a>
                @endif
            </div>
        </div>

        <div class="form-group field_wrapper2">
            <div>

                @if(isset($product))
                    <label for=''>Product Sizes </label><br>
                    @php $r = explode(',',$product->sizes) @endphp
                    @foreach($r as $size)
                        <input type="text" name="sizes[]" value="{{ $size}}"/>
                    @endforeach
                @else
                <label for=''>Product Sizes </label><br> <input placeholder="Product Size" type="text" name="sizes[]"/>
                <a href="javascript:void(0);" class="add_button2" title="Add field"><img src="{{ url('assets/add-icon.png') }}"/></a>
                @endif
            </div>
        </div>


        <div class="form-group">
        	<label for='quantity'>Product Image </label><input type="file" class="form-control" name="prod_img" id="quantity" value="" placeholder="Product Images" >
        </div>

        <div class="form-group">
        	<label for='multi_img'>Multiple Images </label><input type="file" class="form-control" name="multi_img[]" id="multi_img" multiple placeholder="Multiple Images" >
        </div>
        <div class="form-group">
        	<textarea class="form-control" name="description" placeholder="Description">{{ isset($product) ? $product->description : old('description')}}</textarea>
        </div>

		<div class="form-group">
            <center>
            <a href="{{ url('products')}}" class="btn btn-success" style="color:rgb(22, 21, 21)">Back</a>
            <button type="submit" class="btn btn-primary submit">{{ isset($product)? 'Update' : 'ADD' }}</button>
        </center>
        </div>
    </form>
</div>
</body>
<script type="text/javascript">
    $(document).ready(function(){

        var addButton = $('.add_button');
        var wrapper = $('.field_wrapper');
        var fieldHTML = '<div><input type="text" name="color[]" value=""/><a href="javascript:void(0);" class="remove_button"><img src="{{ url("assets/remove-icon.png") }}"/></a></div>'; //New input field html

        $(addButton).click(function(){
            $(wrapper).append(fieldHTML);
        });

        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        });

        var addButton2 = $('.add_button2');
        var wrapper2 = $('.field_wrapper2');
        var fieldHTML2 = '<div><input type="text" name="sizes[]" placeholder="Product Size"/><a href="javascript:void(0);" class="remove_button2"><img src="{{ url("assets/remove-icon.png") }}"/></a></div>'; //New input field html

        $(addButton2).click(function(){
            $(wrapper2).append(fieldHTML2);
        });

        $(wrapper2).on('click', '.remove_button2', function(e){
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        });
    });
    </script>
</html>
