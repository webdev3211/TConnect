@extends('profile.master')

@section('content')

<div class="container">

<ol class="breadcrumb">
<li><a href="{{url('/home')}}">Home</a></li>
<li><a href="{{url('/profile')}}/{{Auth::user()->slug}}">Profile</a></li>
<li><a href="{{url('/editProfile')}}">Edit Profile</a></li>
<li><a href="">Change Image</a></li>
</ol>


@include('profile.sidebar')

<div class="col-md-9">
<div class="panel panel-default">
    <div class="panel-heading">{{Auth::user()->name}}
        <span style="margin-left:230px;" align="center"> 
                <b>Welcome to your profile</b>
        </span>
    </div>

    <div class="panel-body">
        
    <div class="col-md-4 col-md-offset-4" align="center">
        
        <img src="{{url('../')}}/img/{{Auth::user()->pic}}" width="150px" height="150px" class="img-circle" style="user-select:none; border:50%; border:none;"/>
        <br>
        <hr>
        
        
        <form action="{{url('/')}}/uploadPhoto" method="post" enctype="multipart/form-data" class="form-group">
            
            @csrf
            <label for="file" class="form-control">
                <input type="file" name="pic" style="border:none; outline:none;"/>  
                
            </label>
            <br>
            <input  type="submit" class="btn btn-primary form-control" name="btn"/>

            
        </form>
    </div>
</div>
</div>
</div>
</div>
</div>
@endsection
