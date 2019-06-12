@extends('profile.master') 

@section('content')

<div class="col-md-12 ">

<div class="col-md-3 pull-left" style="background-color:#fff; right:10px; overflow-y:scroll; height:100%">
<div class="row" style="padding:16px;">
<div class="col-md-4"> </div>
<div class="col-md-6">Messenger


</div>
<div class="col-md-2 pull-right">
    <a href="{{url('/newMessage')}}">
    <img src="{{url('../')}}/img/compose.png" title="Send New Messages">
</a>
</div>
</div>
<hr>
<div v-for="privateMsg in privateMsgs">
    <li  v-if="privateMsg.status==1" id="privateMsgsArea" onclick="gotolast()" @click="messages(privateMsg.id)" style="list-style:none;
    margin-top:10px; background-color:#F3F3F3" class="row">

    <div class="col-md-3 pull-left">
            <img :src="'{{url('../')}}/img/' + privateMsg.pic"
    style="width:50px; margin: 5px;" class="img-circle">
        </div>

    <div class="col-md-9 pull-left" style="margin-top:5px">
        <b> @{{privateMsg.name}}</b><br>
        <small>Gender: @{{privateMsg.gender}}</small>
    </div>
    </li>

    <li v-else id="privateMsgsArea" onclick="gotolast()" @click="messages(privateMsg.id)" style="list-style:none;
    margin-top:10px; background-color:#fff" class="row">

    <div class="col-md-3 pull-left">
            <img :src="'{{url('../')}}/img/' + privateMsg.pic"
    style="width:50px; margin: 5px;" class="img-circle">
        </div>

    <div class="col-md-9 pull-left" style="margin-top:5px">
        <b> @{{privateMsg.name}}</b><br>
        <small>Gender: @{{privateMsg.gender}}</small>
    </div>
    </li>


</div>
<hr>
</div>


<div class="col-md-6 msg_main" style="background-color: #fff; margin-bottom: 20px;  height:100%" >

<h3 align="center" style="margin-bottom: 20px;">Messages
</h3>
<hr>
<div style="overflow-y: scroll;">

</div>
<div style="min-height: 200px; max-height: 500px; !important;  overflow-y: scroll;" id="msgarea">
    <div v-for="singleMsg in singleMsgs" >
        <div v-if="singleMsg.user_from == <?php echo Auth::user()->id; ?>">
            <div class="col-md-12" style="margin-top:10px">
                    
                    
                <img :src="'{{url('../')}}/img/' + singleMsg.pic" style="width:30px; border-radius:100%; margin-left:5px"
                    class="pull-right">

                    
                <div style="float:right; background-color:#0084ff; padding:5px 15px 5px 15px; margin-bottom: 8px;
                                margin-right:10px;color:#333; border-radius:10px; color:#fff;">
                    @{{singleMsg.msg}}
                </div>
            </div>
        </div>

        <div v-else>
            <div class="col-md-12 pull-right" style="margin-top:10px">
                <img :src="'{{url('../')}}/img/' + singleMsg.pic" style="width:30px; border-radius:100%; margin-left:5px"
                    class="pull-left">
                {{-- <input type="hidden" :value="singleMsg.pic"/>       --}}
                
                    
                <div style="float:left; background-color:#F0F0F0; padding: 5px 15px 5px 15px;  margin-bottom: 8px;
                            border-radius:10px; text-align:right; margin-left:5px ">
                    @{{singleMsg.msg}}
                </div>

            </div>
        </div>
    </div>
    <hr>
    

        <input type="hidden" v-model="conID">
        <textarea id="msgsendbox" placeholder="Type your message here..." 
        onKeydown="msgsent(event)"
        class="col-md-8 form-control" v-model="msgFrom" @keydown="inputHandler" 
        style="margin-top:15px;position: absolute; bottom: 0; left: 0; border:1px solid #f0f0f0; outline: none; user-select: text; white-space: pre-wrap; word-wrap: break-word;">
        </textarea>

</div>

</div>




<div class="col-md-3 pull-right" style="background-color: #fff; left:10px; height:100%">
<div class="row" style="padding:12px;">
<h3 align="center"><a href="http://larabook.me/profile/brad-traversay"> Brad Traversay </a> </h3>
<hr>

<div class="align-items-center" style="text-align: center" >
  <img src="http://larabook.me/img/bradd.jpg" style="border-radius: 50%;">

</div>




</div>
</div>

</div>




@endsection
<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
crossorigin="anonymous"></script>

<script>

$(document).ready(function(){

//  var fileref = document.createElement('script');
//         fileref.setAttribute("type","text/javascript");
//         fileref.setAttribute("src","https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js");
//     document.body.appendChild(fileref);


   
    setTimeout(function(){
        $("li#privateMsgsArea").click();        
        
    //  $('#msgsendbox').emojioneArea({
    //     pickerPosition: "top",
    //     toneStyle: "bullet"
    // });

    }, 1000);
}); 

function gotolast(){
    setTimeout(function(){
        $("#msgarea").animate({
            scrollTop:$("#msgarea")[0].scrollHeight - $("#msgarea").height()
        },100);

        $("body").animate({
            scrollTop:$("body")[0].scrollHeight - $("body").height()
        },100);

        $("#msgsendbox").focus();

    }, 800);
}

function msgsent(e){
    $('#msgsendbox').keydown(function(e){
        if(e.keyCode === 13){
            
        setTimeout(function(){
            
            // var element = $('#msgsendbox').emojioneArea();
            // element[0].emojioneArea.setText('');

            $("#msgarea").animate({
                scrollTop:$("#msgarea")[0].scrollHeight - $("#msgarea").height()
            },100);
            
    //         setTimeout(function(){
    //     $.playSound("http://tusharbaheti28.000webhostapp.com/notification.mp3");                      
    // }, 500); 

        }, 600);   
        }  
    });
}



</script>



