@extends('profile.master')

@section('content')
<div class="container">

<ol class="breadcrumb">
<li><a href="{{url('/home')}}">Home</a></li>
<li><a href="{{url('/profile')}}/{{Auth::user()->slug}}">Profile</a></li>
<li><a href="">Friends</a></li>
</ol>


<div class="row">
@include('profile.sidebar')


<div class="col-md-9">
<div class="panel panel-default">
<div class="panel-heading">{{Auth::user()->name}}, Your Friends</div>

<div class="panel-body">
<div class="col-sm-12 col-md-12">
@if ( session()->has('msg') )
<p class="alert alert-success">
        {{ session()->get('msg') }}
    </p>
@endif
@if ( session()->has('msg-unfriend') )
<p class="alert alert-danger">
        {{ session()->get('msg-unfriend') }}
    </p>
@endif
@foreach($friends as $uList)

<div class="row" style="border-bottom:1px solid #ccc; margin-bottom:20px">
<div class="col-md-2 pull-left" style="margin-bottom:13px;">
<img src="{{url('../')}}/img/{{$uList->pic}}"  width="80px" height="80px" class="img-circle"/>
</div>

<div class="col-md-7 pull-left">
<h3 style="margin:0px;margin-bottom: 5px; font-size: 15px;">
    <a style="text-decoration:none;" href="{{url('/profile')}}/{{$uList->slug}}">
        {{ucwords($uList->name)}}
    </a>
</h3>

<p><b>Gender:</b> {{$uList->gender}}</p>
    <p><b>Email:</b> {{$uList->email}}</p>

</div>

<div class="col-md-3 pull-right">

<p>

<a href="{{url('/unfriend')}}/{{$uList->name}}/{{$uList->id}}"  style="background:#f0f0f0;" class="btn btn-default btn-sm">Unfriend</a>

</p>

</div>
<br><br>
</div>
@endforeach
</div>

<br>

</div>
</div>
</div>
</div>
</div>
@endsection