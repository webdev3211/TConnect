@extends('profile.master')

@section('content')

<div class="col-md-12">

        <div class="col-md-3 pull-left" style="background-color:#fff; right:10px; height:100%">
        <div class="row" style="padding:16px;">

         <div class="col-md-7"><b>Friend List</b></div>
             <div class="col-md-5 pull-right">
                <a href="{{url('/messages')}}" class="btn btn-sm btn-info">All messages</a>
            </div>
        </div>

            @foreach($friends as $friend)

            <li  @click="friendID({{$friend->id}})" v-on:click="seen = true" style="list-style:none;
                margin-top:10px; background-color:#F3F3F3" class="row">

                <div class="col-md-3 pull-left">
                    <img src="{{url('../')}}/img/{{$friend->pic}}"
                    style="width:50px; border-radius:100%; margin:5px">
                </div>

                <div class="col-md-9 pull-left" style="margin-top:5px">
                    <b> {{$friend->name}}</b><br>
                    <small>Gender: {{$friend->gender}}</small>
                </div>
            </li>
            @endforeach
   <hr>
  </div>



<div class="col-md-6" style="background-color: #fff; margin-bottom: 40px;  height:80%">
   <h3 align="center">Messages</h3>
   <p id="alertbox" class="alert alert-success">@{{msg}}</p>

   <div  v-if="seen">
      <input type="hidden" v-model="friend_id">
      <textarea id="newmsgbox" class="col-md-12 form-control" 
        style="margin-bottom: 20px;"
      placeholder="Type your message here...." v-model="newMsgFrom" rows="10" cols="30">
          
     </textarea><br>
      <br>
      <br>
      <input type="button" id="SendMsgBtn" class="btn btn-primary form-control" value="Send Message" @click="sendNewMsg()" style="margin-bottom: 30px;">
  </div>
</div>


<div class="col-md-3 pull-right" style="background-color: #fff; left:10px; height:100%;">
<div class="row" style="padding:12px;">
    <h3 align="center">User Information</h3>
    <hr>
    
    
    <br> Hello
    <br> Hello
    <br> Hello
    <br> Hello
    <br> Hello
    <br> Hello
    <br> Hello
</div>
</div>


</div>


@endsection

