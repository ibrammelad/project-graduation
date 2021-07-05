
@extends('layouts.admin')
	<title>add hospital</title>

<link href="{{ asset('style/adminstyle.css') }}" rel="stylesheet">
</head>
<body>
<ul class="header" style="position: fixed; top: 20; right: 50;">

    <li title="setting" >
        <div class="dropdown">
            <button type="button" class="btn text-dark dropdown-toggle" data-toggle="dropdown"><i class="fa fa-th-list" aria-hidden="true"></i></button>
            <div class="dropdown-menu">

                <a class="dropdown-item" href="{{route('doctorPage')}}" title="review-doctors">
                    <span>review doctors</span>
                    <div class="fa fa-angle-right" aria-hidden="true"></div>
                </a>
                <a class="dropdown-item" href="{{route('viewNurse')}}" title="review-nurse">
                    <span>review nurse</span>
                    <div class="fa fa-angle-right" aria-hidden="true"></div>
                </a>
                <a class="dropdown-item" href="{{route('FirstPage')}}" title="have covid-19">
                    <span>اhave a covid-19</span>
                    <div class="fa fa-angle-right" aria-hidden="true"></div>
                </a>
                <a class="dropdown-item" href="{{route('susbectedPage')}}" title="susbected">
                    </i> <span>susbected</span>
                    <div class="fa fa-angle-right" aria-hidden="true"></div>
                </a>
                <a class="dropdown-item" href="{{route('hospitalPage')}}" title="add hospital">
                    </i> <span>add hospital</span>
                    <div class="fa fa-angle-right" aria-hidden="true"></div>
                </a>



    </li>
</ul>
	<div class="hos-div-1">

		<div class="hos-div-3">
			<div>add hospital: </div>
            @include('layouts.alerts.success')
            @include('layouts.alerts.errors')
		<form action="{{route('storeHospital')}}" class="hos-form form " method="post">
			@csrf
            <table>
			<tr><td>
			<span> hospital name: </span></td><td><input type="text" name="name"><br>
			</td></tr>
			<tr>
			<td><span>Longitude : </span></td><td><input type="text" name="lang">
			</td></tr>
			<tr>
			<td><span>Latitude : </span></td><td><input type="text" name="lat">
			</td></tr>

            </table>
            <button type="submit" > save </button>

        </form>
	    </div>
	</div>
</body>
</html>
