<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TConnect</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/main1.css') }}"> --}}
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
    body{
        background-color: #e9ebee;
    }

.msg_main{
  background-color:#ffff;
  border-left:5px solid #F5F8FA;
  position: absolute;
  left: calc(25%);
}
.msg_right{
  background-color:#ffff;
  border-left:5px solid #F5F8FA;
  min-height:600px;
  position:fixed;
  right:0px
}
.msgDiv{
 position:fixed; left:0
}
.left-sidebar li { padding:10px;
  border-bottom:1px solid #ddd;
list-style:none; margin-left:-20px}
.msgDiv li:hover{
  cursor:pointer;
}
.jobDiv{border:1px solid #ddd; margin:10px; width:30%; float:left; padding:10px; color:#000}
.caption li {list-style:none !important; padding:5px}
.jobDiv .company_pic{width:50px; height:50px; margin:5px}
.jobDetails h4{border:1px solid green; width:60%;
padding:5px; margin:0 auto; text-align:center; color:green}
.jobDetails .job_company{padding-bottom:10px; border-bottom:1px solid #ddd; margin-top:20px}
.jobDetails .job_point{color:green; font-weight:bold}
.jobDetails .email_link{padding:5px; border:1px solid green; color:green}


</style>
<body>
    @include('layouts.partials.navbar')
    <div id="app">
    
        {{-- <div class="container">
            <div class="row"> --}}
                @yield('content')
            {{-- </div>            
    
        </div> --}}
    </div>

    

</body>

</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


{{--
<!-- Latest compiled and minified JS -->--}}
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="{{ asset('js/profile.js') }}" defer></script>
