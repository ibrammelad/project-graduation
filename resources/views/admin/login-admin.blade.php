<!DOCTYPE html>
<html>
<head>
	<title>admin login</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="{{ asset('style/adminstyle.css') }}" rel="stylesheet">
</head>
<body>

<form action="{{route('loginPost')}}"  method="post" class="form-group">
{{--    @include('layouts.alerts.success')--}}
{{--    @include('layouts.alerts.errors')--}}
    @csrf
	<h2 class="form-group-h2">admin login: </h2>
	<span class="form-group-span fa fa-user "> username:</span>
	<input class="form-group-input" type="text" name="email" placeholder="enter your username">
	<br>
	<span class="form-group-span fa fa-lock "> password:</span>
	<input class="form-group-input" type="password" name="password" placeholder="enter your password"><br>
	<button class="form-group-button" type="submit" >login</button>
</form>
</body>
</html>
