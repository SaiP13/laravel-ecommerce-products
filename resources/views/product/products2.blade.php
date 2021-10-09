<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products</title>


    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="{{ url('assets/style.css') }}">
    <link rel="stylesheet" type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css">

    <link href="https://www.jqueryscript.net/demo/Highly-Customizable-Range-Slider-Plugin-For-Bootstrap-Bootstrap-Slider/dist/css/bootstrap-slider.css" rel="stylesheet" type="text/css">
    <style>
        #slider5a .slider-track-high, #slider5c .slider-track-high {
            background: green;
        }

        #slider5b .slider-track-low, #slider5c .slider-track-low {
            background: red;
        }

        #slider5c .slider-selection {
            background: yellow;
        }
        </style>



</head>
<body>


<nav class="navbar navbar-expand-sm navbar-light bg-white border-bottom">

    <a class="navbar-brand ml-2 font-weight-bold" href="#">
        <span id="burgundy"></span><span id="orange">Products</span>
    </a>

    <div class="collapse navbar-collapse" id="navbarColor">
        <ul class="navbar-nav">
            <li class="nav-item rounded bg-light search-nav-item">
                <input type="text" id="search" class="bg-light searchProd" placeholder="Search Products">
            </li>
        </ul>
    </div>


    @if(session('userid'))

        <a class="" href="">
            <span id="burgundy"></span><span id="blue">{{ ucfirst(session('username')) }}</span>
        </a>
        &nbsp; | &nbsp;

        <a class="" href="{{ url('add-product')}}">
            <span id="burgundy"></span><span id="blue">Add</span>
        </a>
        &nbsp; | &nbsp;
        <a class="" href="{{ url('wishList')}}">
            <span id="burgundy"></span><span id="blue">Whish List</span>
        </a>
        &nbsp; | &nbsp;
        <a class="" href="{{ url('logout')}}">
            <span id="burgundy"></span><span id="blue">Logout</span>
        </a>
        &nbsp; | &nbsp;
    @else
        <a class="" href="{{ url('login')}}">
            <span id="burgundy"></span><span id="blue">Login</span>
        </a>
        &nbsp; | &nbsp;
        <a class="" href="{{ url('signup')}}">
            <span id="burgundy"></span><span id="blue">Signup</span>
        </a>
        &nbsp; | &nbsp;
    @endif

</nav>

<!-- Sidebar filter section -->
<section id="sidebar">

    <p> Home | <b>Products</b></p>

    <div class="border-bottom pb-2 ml-2">
        <h4 id="burgundy">Filters</h4>
        <div class="filter">
            <a href=""><button class="">Clear</button> </a>
        </div>
    </div>

    <div class="py-2 border-bottom ml-3">
        <h5 id="burgundy">Price</h5>
        <b id="min_value">Rs. {{ $price['min'] }}</b> <input id="ex2" type="text" class="span2" value="" data-slider-min="{{ $price['min'] }}" data-slider-max="{{ $price['max'] }}" data-slider-step="5" data-slider-value="[{{ $price['min']}},{{ $price['max']}}]"/> <b id="max_value">Rs. {{$price['max']}}</b>
    </div>

    <div class="py-2 ml-3">
        <h5 id="burgundy">Colors</h5>
        @foreach($colors as  $r)
            <div class="form-group"> <input class="color_check" type="checkbox" value="{{$r->color }}" id="25off"> <label for="25">{{ ucfirst($r->color) }}</label> </div>
        @endforeach
    </div>

</section>

@if(session('status'))
<strong style="color:green"><center>{{session('status')}}</center></strong>
@endif

<!-- products section -->
<section id="products">

    <div class="container">
        <div class="d-flex flex-row">
            <div class="ml-auto mr-lg-4">
            </div>
        </div>

            <div id="ajax_result">
            </div>

    </div>

</section>

</body>

{{-- <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> --}}
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://www.jqueryscript.net/demo/Highly-Customizable-Range-Slider-Plugin-For-Bootstrap-Bootstrap-Slider/dist/bootstrap-slider.js"></script>

<script>
    $("#ex2").slider({});
</script>
<script>
    $(document).ready(function(){

        ajax_call();

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
                        $(".filter").show();
                        $("#ajax_result").html(data);
                    } else {
                        $("#ajax_result").html("<p>No data Avaliable</p>");
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

    });
</script>
</html>
