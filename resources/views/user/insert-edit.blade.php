<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<title>add-edit</title>
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
    <form action="{{ isset($user) ? URL::to('/update',$user->id) : URL::to('/registerAction') }}" method="POST" enctype="multipart/form-data">
         {{-- {{ csrf_field() }} --}}
        @if(session('status'))
            <center style="color:green">{{ session('status') }}</center>
        @endif
        @csrf
        @if(isset($user))

            <h4 class="text-center">Edit user</h4>
        @else
            <h4 class="text-center">Add user</h4>
        @endif
		<hr>
        <div class="form-group">
        	<input type="text" class="form-control" name="name" value="{{ isset($user)?$user->name:old('name') }}" placeholder="User Name" >
            @if($errors->has('name'))
                <p style="color:red">{{ $errors->first('name')}}</p>
            @endif
        </div>
        <div class="form-group">
        	<input type="email" class="form-control" autocomplete="off" name="email" value="{{ isset($user)?$user->email:old('email')}}" placeholder="Email Address" @if(isset($user)) {{ "disabled" }} @endif >
            @if($errors->has('email'))
                <p style="color:red">{{ $errors->first('email')}}</p>
            @endif
        </div>


        <div class="form-group">
            <input type="password" class="form-control" autocomplete="off" name="password" value="{{ old('password') }}" placeholder="Password">
            @if($errors->has('password'))
                <p style="color:red">{{ $errors->first('password')}}</p>
            @endif
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
            @if($errors->has('confirm_password'))
                <p style="color:red">{{ $errors->first('confirm_password')}}</p>
            @endif
        </div>




		<div class="form-group">
            <a href="{{ url('products')}}" class="btn btn-success" style="color:red">Back</a>
            @if(isset($user))
                <button type="submit" class="btn btn-primary submit">Update</button>
            @else
                <button type="submit" class="btn btn-primary submit">Add</button>
            @endif
        </div>
    </form>
</div>
</body>


</html>
