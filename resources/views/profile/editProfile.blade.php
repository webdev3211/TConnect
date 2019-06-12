@extends('profile.master')

@section('content')

<div class="container">

    <ol class="breadcrumb">
        <li><a href="{{url('/home')}}">Home</a></li>
        <li><a href="{{url('/profile')}}/{{Auth::user()->slug}}">Profile</a></li>
        <li><a href="">Edit Profile</a></li>
    </ol>
    <br>
    <div class="row justify-content-center">
       @include('profile.sidebar')
            <div class="col-md-9">

                <div class="panel panel-default">
                    <div class="panel-heading">{{Auth::user()->name}}</div>
                   
                    <div class="panel-body">
                        <div class="col-sm-12 col-md-12">
                            <div class="thumbnail">
                                <h3 align="center">{{ucwords(Auth::user()->name)}}</h3>
                                <img src="{{url('../')}}/img/{{Auth::user()->pic}}" width="150px" height="150px" class="img-circle" style="border:50%; border:none;"/>

                                <div class="caption">

                                    <p align="center">{{$data->city}} - {{$data->country}}</p>
                                    <p align="center">  <a href="{{url('/')}}/changePhoto"  class="btn btn-primary" role="button">Change Image</a></p>
                                </div>
                            </div>
                        </div>

                        <br>    
                        <label style="margin-left: 20px; padding: 10px 15px;" class="label label-default">
                                Update your Info
                        </label>
                       
                        <br><br>
                        <div class="col-sm-12 col-md-12">


                        <form action="{{ url('/updateProfile') }}" method="post">
                            @csrf
                            <div class="col-md-6">

                                <div class="input-group">
                                    <span  id="basic-addon1">City Name</span>
                                    <input type="text" class="form-control" placeholder="City Name" name="city" value="{{$data->city}}">
                                </div>
                                <br>
                                <div class="input-group">
                                    <span  id="basic-addon1">Country Name</span>
                                    <input type="text" class="form-control" placeholder="Country Name" name="country" value="{{$data->country}}">
                                </div>


                            </div>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <span  id="basic-addon1">About</span>
                                    <textarea rows="10" cols="45" type="text" class="form-control" name="about">{{$data->about}}</textarea>
                                </div>

                                <br>
                                
                            </div>
                            <br><br><br><br>
                            <div class="input-group col-md-12">
                                <input type="submit" style="margin-top: 30px;" class="btn btn-primary form-control">
                            </div>

                        </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>

<style>

    #basic-addon1{
        font-weight:bold;
    }

    .form-control{
        margin-top: 10px;
    }

</style>

@endsection
