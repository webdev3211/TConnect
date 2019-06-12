@extends('profile.master') @section('content')

<div class="container">

<ol class="breadcrumb">
<li>
<a href="{{url('/home')}}">Home</a>
</li>
<li>
<a href="{{url('/profile')}}/{{Auth::user()->slug}}">Profile</a>
</li>
<li>
<a href="">Find Friends</a>
</li>
</ol>


<div class="row">
@include('profile.sidebar')


<div class="col-md-9">
<div class="panel panel-default">
    <div class="panel-heading">{{Auth::user()->name}}</div>

    <div class="panel-body">
        <div class="col-sm-12 col-md-12">
            @foreach($allUsers as $uList)
            <div class="row" style="border-bottom:1px solid #ccc; margin-bottom:20px">
                <div class="col-md-2 pull-left">
                    <img src="{{url('../')}}/img/{{$uList->pic}}" width="80px" height="80px" class="img-circle" />
                </div>
                <div class="col-md-7 pull-left">
                    <h3 style="margin:0px; font-size: 15px;">
                        <a style="text-decoration:none;" href="{{url('/profile')}}/{{$uList->slug}}">
                            {{ucwords($uList->name)}}</a>
                    </h3>
                    <br>
                    <p>Lives in
                        <i class="fa fa-globe"></i> {{$uList->city}}, {{$uList->country}}</p>
                    <p>{{$uList->about}}</p>

                </div>
                <div class="col-md-3 pull-right">

                    <?php
$check = DB::table('friendships')
    ->where('user_requested', '=', $uList->id)
    ->where('requester', '=', Auth::user()->id)
    ->first();


if($check ==''){
?>
                        <p>
                            <a href="{{url('/')}}/addFriend/{{$uList->id}}" class="btn btn-default btn-sm" id="add-friend">
                                <i class="fa fa-user-plus"></i>&nbsp;&nbsp; Add Friend</a>
                        </p>

                        <?php } 
else {

$checkiffriendstowhomusentrequest = DB::table('friendships')
    ->where('user_requested', '=', $uList->id)
    ->where('requester', '=', Auth::user()->id)
    ->where('status', '1')
    ->first();


if($checkiffriendstowhomusentrequest == ''){
    ?>
                        <p class="btn btn-default btn-sm">
                            <i class="fa fa-user-plus"></i>&nbsp;&nbsp;Friend Request Sent</p>
                        <?php } else { ?>
                        <p>
                            <a href="#" id="add-friend" style="width:100px;font-size: 13px;" class="btn btn-default btn-sm">
                                <i class="fa fa-check" aria-hidden="true"></i>&nbsp;&nbsp;Friends
                            </a>
                        </p>
                        <?php }
    } 
?>
                </div>
                <br>
                <br>
            </div>
            @endforeach
        </div>
    </div>
</div>
</div>
</div>
</div>
@endsection

<style>
#add-friend {
background: #f0f0f0;
}

#add-friend:hover {
background: #D0D0D0;
}

#friends:hover {
background: red;

}

</style>
