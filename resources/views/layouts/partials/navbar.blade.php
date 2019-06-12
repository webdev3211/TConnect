<nav class="navbar navbar-inverse navbar-static-top" style="background:#3B5998; outline:none; border: none; color:white; height: 15px;">
<div class="container">
<div class="navbar-header">

    <!-- Collapsed Hamburger -->
    <button type="button" class="navbar-toggle collapsed"
    data-toggle="collapse" data-target="#app-navbar-collapse">
        <span class="sr-only">Toggle Navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>


<!-- Branding Image -->
<a class="navbar-brand" href="{{ url('/') }}" style="background:#3B5998; outline:none; border: none; color:white;">
    {{-- {{ config('app.name', 'LaraBook') }} --}}
    <a href="/" id="box">L</a>
</a>
{{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
</button> --}}
</div>

<div class="collapse navbar-collapse" id="app-navbar-collapse">
<!-- Left Side Of Navbar -->
{{-- <ul class="nav navbar-nav navbar-left">
    <div id="app">
            <li>
                <div style="margin-top: 8.5px;">
                    <input type="text" class="form-control" 
                    placeholder="Search" style="margin-left: 25px; margin-top: 8.5x;" 
                    v-model="qry" v-on:Keyup="autoComplete"/>
                    
                    <div class="input-group-btn" style="position:relative; top:-33.2px; right: -25px; border:none; float:right;">
                        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                    </div>
    
                </div>
                    
                <div v-if="results.length&&qry.length>0" class="panel-footer" style="position:absolute; margin-left: 25px; border:1px solid #ccc;
                background:#fff; width:16%;">
                    <div style="float:left;">
                        <ul style="-webkit-padding-start: 0px; list-style-type:none;" v-for="result in results">
                                <li id="searchlist">
                                    <img :src="'{{url('../')}}/img/' +  result.pic" style="width:30px; border-radius:100%; margin: 5px;">    
                                    <a :href="'{{url('profile')}}/' +  result.slug">
                                    <b>@{{result.name}} </b>
                                    </a>
                                </li>   
                            </ul>
                    </div>
                </div>
            </li>
        </div>
</ul> --}}

<!-- Right Side Of Navbar -->
<ul class="nav navbar-nav navbar-right">
    <!-- Authentication Links -->
    @if (Auth::guest())
        <li id="loginbtn"><a href="{{ route('login') }}" style="background:#3B5998; outline:none; border: none; color:white;">Login</a></li>
        <li id="registerbtn"><a href="{{ route('register') }}" style="background:#3B5998; outline:none; border: none; color:white;">Register</a></li>
    @else
        {{--notification--}}
    {{-- <notification :userid="{{auth()->id()}}" :unreads="{{auth()->user()->unreadNotifications}}"></notification> --}}

    @if(Auth::check())



<li>
    <a id="nav-item" href="{{ url('/messages') }}"> <img style="position:relative;" src="{{url('/')}}/img/msg_icon.png" height="18px" width="20px"/> 

        <span class="badge"  style="background:red; position: relative; top: -10px; left:-10px">
                @include('profile.unread')
        </span>

        
    </a>
</li>    
        <li><a id="nav-item" href="{{ url('/profile') }}/{{Auth::user()->slug}}"><b>Profile</b></a></li>
        <li><a id="nav-item" href="{{ url('/findFriends') }}"><b>Find Friends</b></a></li>
        {{-- <li><a id="nav-item" href="{{ url('/requests') }}">My Requests  </a></li> --}}
        <li><a style="height:50px;" id="nav-item" href="{{url('/requests')}}"><img src="https://image.ibb.co/kbMu3U/fa_requests.png" height="30px" width="30px">
            <span class="badge badge-success"  style="background:grey; position: relative; top: -15px; left:-10px">
                        {{App\friendships::where('status', 0)
                        ->where('user_requested', Auth::user()->id)
                        ->count()}}</span></a></li>
       
        <li><a style="color:black;height:50px;" id="nav-item" href="{{ url('/friends') }}">
            <i class="fa fa-users fa-2x"></i>
        </a></li>    
                        
    @endif

    <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"
               role="button" aria-expanded="false" style="height: 50px;">             
               <i class="fa fa-globe fa-2x" aria-hidden="true"></i>
              
               <span class="badge" style="background:red; position: relative; top: -15px; left:-10px">
             {{App\notifications::where('status', 1)
                 ->where('user_hero', Auth::user()->id)
                  ->count()}}
                </span>
            </a>

            <?php
            $notes = DB::table('users')
            ->leftJoin('notifications', 'users.id', 'notifications.user_logged')
            ->where('user_hero', Auth::user()->id)
            ->where('status', 1) //unread
            ->orderBy('notifications.created_at', 'desc')
            ->get();

            ?>
           <ul class="dropdown-menu" role="menu" style="width:320px; margin: 0; padding: 0; list-style-type: none;">
                @foreach($notes as $note)
                   <a href="{{url('/notifications')}}/{{$note->id}}">
                    @if($note->status==1)
                        <li style="background:#E4E9F2; padding:10px">
                    @else
                         <li style="padding:10px">
                    @endif
                        <div class="row">
                            <div class="col-md-2" style="margin-right: 5px;">
                                <img src="{{url('../')}}/img/{{$note->pic}}" style="width:50px; background:#fff; border:none" class="img-circle">
                            </div>

                            <div class="col-md-9">

                                <b style="color:tomato; font-size:90%">{{ucwords($note->name)}}</b>
                                <span style="color:#000; font-size:90%">{{$note->note}}</span>
                                <br/>
                                <small style="color:#90949C">
                                    <i aria-hidden="true" class="fa fa-users" style="color: #3366FF;"></i>
                                    {{date('F j, Y', strtotime($note->created_at))}} at {{date('H: i', strtotime($note->created_at))}}</small>
                            </div>

                        </div>

                        </li>
                    </a>
                    <a href="#">
                            <li style="margin: 0; padding: 1; background: grey; height: 0.5px;" role="separator" class="divider"></li>
                        </a>
                @endforeach
            </ul>
               
        


    </li>

    <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="height: 50px; color:white;">
                    <img src="{{url('../')}}/img/{{Auth::user()->pic}}" width="30px" height="30px" class="img-circle" />
                    
                <span style="margin-left:15px;" class="caret"></span>
            </a>


            <ul class="dropdown-menu" role="menu">
                    <li> <a href="{{ url('/profile') }}/{{Auth::user()->slug}}" >   Profile  </a> </li>
                    <li role="separator" class="divider"></li>
                <li> <a href="{{ url('editProfile') }}" >  Edit Profile  </a> </li>
                <li role="separator" class="divider"></li>
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>


            </ul>
        </li>

    @endif
</ul>
</div>
</div>
</nav>

<style>

#nav-item{
color: white;
}

#nav-item:hover{
background: #4267b2;

}

.dropdown-menu li{ 
min-width: 150px; 

}

#box{
    margin-top: 5px;
    	border: 1px solid #3B5998; outline:none; border: none;
        display: inline-block;
        padding: 0.25px 10px;
        color: #3B5998; outline:none; border: none;
        font-size: 25px;
        font-weight: bold;
        background: white ;
        text-decoration: none;
    }
#searchlist:hover{
    background: #e9ebee;
}

</style>