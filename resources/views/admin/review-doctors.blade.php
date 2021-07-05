
	<title>review doctors</title>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"  />
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <link href="{{ asset('style/adminstyle.css') }}" rel="stylesheet">
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


</div></div>
    </li>
</ul>

<div class="container">
	<h1 class="container-h1">doctors review page </h1>
	<table class="table" style="margin-top: 50px;">
        @include('layouts.alerts.success')
        @include('layouts.alerts.errors')
		 	 @foreach($doctors as $doctor)

		<tr class="table-tr">
			<!-------------------------------------tr 1------------------------------>
			<td>
			<img src="https://7asbv0.000webhostapp.com/images/{{$doctor->image}}" alt="doctor" width="150" height="150">
			</td>
			<td>
			<h3>{{$doctor->user->name}} </h3>
			<h5>Available Time: </h5>
			<span style="color: #1cbbd0;">From : </span> <span>{{$doctor->from }}</span><br>
			<span style="color: #1cbbd0;">To : </span> <span>{{$doctor->to }}</span><br>
			<span style="color: #1cbbd0;">longitude : </span><span> {{$doctor->lang}}</span>
		    </td>
		    <td class="td">
			<span style="color: #1cbbd0;">latitude : </span><span> {{$doctor->lat}}</span><br>
			<span style="color: #1cbbd0;">fees : </span><span> {{$doctor->salary}}</span><br>
			<span style="color: #1cbbd0;">qualifications : </span><span> {{$doctor->qualifications}}</span><br>
			<span style="color: #1cbbd0;">servses : </span><span> {{$doctor->services}}</span><br>
			</td>

			<td class="td-radio" style="padding-top: 70px;">
                <form action="{{route('acceptDoctor' , $doctor->id)}}" method="post">
                    @csrf
                    <button type="submit" > accept</button>
                </form>
                <form action="{{route('refuseDoctor' , $doctor->id)}}" method="post">
                    @csrf
                    <button type="submit" > refuse</button>
                </form>
		    </td>
		</tr>
		<!-------------------------------------tr 2------------------------------>
		 @endforeach
	</table>
	</div>
</body>
<script>
  $(function() {
    $('.toggle-class3').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var user_id = $(this).data('id');

        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/changeStatus_doctor',
            data: {'status': status, 'user_id': user_id},
            success: function(data){
              console.log(data.success)
            }
        });
    })
  })
</script>
</html>
