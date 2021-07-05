<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="{{ asset('style/adminstyle.css') }}" rel="stylesheet">
</head>
<body>
<ul class="header-nav-ul">
			
			
		

			<li title="setting" >
					<div class="dropdown">
					<button type="button" class="btn text-dark dropdown-toggle" data-toggle="dropdown"><i class="fa fa-th-list" aria-hidden="true"></i></button>
					<div class="dropdown-menu">
				
				<a class="dropdown-item" href="{{url('/review-doctors')}}" title="review-doctors">
				   <span>review doctors</span>
					<div class="fa fa-angle-right" aria-hidden="true"></div>	
				</a>
				<a class="dropdown-item" href="{{url('/review-nurse')}}" title="review-nurse">
				 <span>review nurse</span>
				 <div class="fa fa-angle-right" aria-hidden="true"></div>	
				</a>
				<a class="dropdown-item" href="{{url('/i-have-covid-review')}}" title="have covid-19">
					 <span>اhave a covid-19</span>
					<div class="fa fa-angle-right" aria-hidden="true"></div>	
				</a>
				<a class="dropdown-item" href="{{url('/iam-susbected-review')}}" title="susbected">
					</i> <span>susbected</span>
					<div class="fa fa-angle-right" aria-hidden="true"></div>	
				</a>
				<a class="dropdown-item" href="{{url('/add-hospital')}}" title="add hospital">
					</i> <span>add hospital</span>
					<div class="fa fa-angle-right" aria-hidden="true"></div>	
					</a>
				
			
				
			</li>
</ul>
</body>
</html>