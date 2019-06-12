@extends('profile.master')


@section('content')

<div class="container">

<ol class="breadcrumb">
<li><a href="{{url('/home')}}">Home</a></li>
<li><a href="{{url('/profile')}}/{{Auth::user()->slug}}">Profile</a></li>

</ol>

@include('profile.sidebar')


@foreach($userData as $uData)

<div class="col-md-9">
<div class="panel panel-default">
<div class="panel-heading">{{ $uData->name }}</div>

<div class="panel-body">
    <div class="row">
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <h3 align="center">{{ ucwords($uData->name) }}</h3>
                <img src="{{url('../')}}/img/{{ $uData->pic }}" width="150px" height="150px" class="img-circle" style="border-radius:50%;"/>

                <div class="caption">

                    <p align="center">{{ $uData->city }} - {{ $uData->country }}</p> 
                    
                    <p align="center">
                    @if($uData->user_id == Auth::user()->id)
                        <a href="{{ url('/editProfile') }}" class="btn btn-primary btn-sm" role="button">
                            Edit Profile
                        </a>                                        
                    @endif
                    </p>

                </div>
            </div>
        </div>


        <div class="col-sm-6 col-md-4">
            <h4 class=""><span class="label label-default">About</span></h4>
            <p> {{ $uData->about }} </p>
        </div>
    </div>


</div>
</div>
</div>
@endforeach



</div>

@endsection


