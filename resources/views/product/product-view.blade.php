
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html lang="en">
  <head>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Product Details</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ url('assets/view-style.css') }}">
  </head>

  <body>

	<div class="container">
		<div class="card">
			<div class="container-fliud">
				<div class="wrapper row">
					<div class="preview col-md-6">

						<div class="preview-pic tab-content">
						  <div class="" id="pic-1"><img src="{{ url('images/',$product->prod_img) }}" height="80%" width="50"/></div>

						</div>
						<ul class="preview-thumbnail nav nav-tabs">
						 @foreach($images as $row)
						    <li><a data-target="#pic-2" data-toggle="tab"><img src="{{ url('images/',$row->prod_image) }}" height="70px"/></a></li>
						  @endforeach
						</ul>

					</div>
					<div class="details col-md-6">
						<h3 class="product-title">{{ $product->name }}</h3>

						<p class="product-description">{{ $product->description}}</p>
						<h4 class="price">current price: <span>Rs.{{$product->price }}</span></h4>
						<h5 class="sizes">sizes:
							@php $sizes = explode(',',$product->sizes) @endphp
                                @foreach($sizes as $r)

                                    <span class="size" data-toggle="tooltip" title="small">{{ ucfirst($r) }}</span>
                                @endforeach
						</h5>
						<h5 class="colors">colors:
							{{-- @php $colors = explode(',',$product->colors) @endphp
                                @foreach($colors as $r)

                                    <span class="size" data-toggle="tooltip" title="small">{{ ucfirst($r) }}</span>
                                @endforeach --}}
                                @php $colors = DB::table('colors')->where('product_id',$product->id)->get(); @endphp
                                @foreach($colors as $r)
                                <span class="size" data-toggle="tooltip" title="small">{{ ucfirst($r->color) }}</span>
                                @endforeach
							{{-- <span class="color blue"></span> --}}
						</h5>
						<div class="action">
							<a href="{{url('products')}}" class="btn btn-primary" type="button">BACK</a>
							<a href="{{ url('edit-product',$product->id) }}" class="btn btn-success" type="button">EDIT</a>
							<a href="{{ url('delete-product',$product->id) }}" class="btn btn-danger" type="button" onclick="return confirm('Are you sure')">DELETE</a>
							{{-- <button class="like btn btn-default" type="button"><span class="fa fa-heart"></span></button> --}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
  </body>
</html>
