@extends('layouts.admin')
	<title> susbected review </title>

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

<div class="container">
	<h1 class="container-h1"> iam susbected review</h1>
    @include('layouts.alerts.success')
    @include('layouts.alerts.errors')
	<table class="table" style="margin-top: 50px;">
        @foreach($users as $order)
		<tr class="table-tr">
			<!-------------------------------------tr 1------------------------------>
		<tr class="table-tr">
			<td>
			<img src="https://7asbv0.000webhostapp.com/images/{{$order->image_susb}}" alt="user" width="150" height="150">
			</td>
			<td>
			<h3>{{$order->user->name}} </h3>

		    </td>


			<td class="td-radio">
			<div class="div-radio ">
                <form action="{{route('acceptSusb' , $order->id)}}" method="post">
                    @csrf
                    <button type="submit" > accept</button>
                </form>
                <form action="{{route('refuseSusb' , $order->id)}}" method="post">
                    @csrf
                    <button type="submit" > refuse</button>
                </form>
			</div>
		    </td>
		</tr>
        @endforeach
	</table>
	</div>
</body>
</html>
