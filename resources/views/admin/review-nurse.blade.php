@extends('layouts.admin')
<title>review doctors</title>

<body>
    <ul class="header" style="position: fixed; top: 20; right: 50;">

    <li title="setting">
        <div class="dropdown">
            <button type="button" class="btn text-dark dropdown-toggle" data-toggle="dropdown"><i class="fa fa-th-list"
                                                                                                  aria-hidden="true"></i>
            </button>
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
            </div></div>

    </li>
</ul>
<div class="container">
    <h1 class="container-h1">nurses review page </h1>
    <table class="table" style="margin-top: 50px;">
        @include('layouts.alerts.success')
        @include('layouts.alerts.errors')
        @foreach($nurses as $nurse)
            <tr class="table-tr">
                <!-------------------------------------tr 1------------------------------>
                <td>
                    <img src="https://7asbv0.000webhostapp.com/images/{{$nurse->user->image}}" alt="doctor" width="150"
                         height="150">
                </td>
                <td>
                    <h3>{{$nurse->user->name}} </h3>
                    <h5>Available Time: </h5>
                    <span style="color: #1cbbd0;">From : </span> <span>{{$nurse->from}}</span><br>
                    <span style="color: #1cbbd0;">To : </span> <span>{{$nurse->to}}</span><br>

                </td>
                <td class="td">
                    <span style="color: #1cbbd0;">fees : </span><span> {{$nurse->salary}}</span><br>
                    <span style="color: #1cbbd0;">qualifications : </span><span> {{$nurse->qualifications}}</span><br>
                    <span style="color: #1cbbd0;">servses : </span><span>  {{$nurse->services}}</span><br>
                </td>

                <td class="td-radio">
                    <form action="{{route('acceptNurse' , $nurse->id)}}" method="post">
                        @csrf
                        <button type="submit"> accept</button>
                    </form>
                    <form action="{{route('refuseNurse' , $nurse->id)}}" method="post">
                        @csrf
                        <button type="submit"> refuse</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</div>
</body>
</html>
