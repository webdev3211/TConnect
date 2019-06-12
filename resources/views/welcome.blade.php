<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>TConnect</title>

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
crossorigin="anonymous"></script>


<!-- Styles -->
<style>

    

html, body {
background-color: #e9ebee;
font-family: 'Raleway', sans-serif;
font-weight: 100;
margin: 0;
}

#upload_wrap:hover{
    background:grey;
}

.top_bar{
position:relative; width:99%; top:0; padding:5px; margin:0 5
}
.full-height {
margin-top:50px
}
.flex-center {
align-items: center;
display: flex;
justify-content: center;
}
.position-ref {
position: relative;
}
.top-right {
position: absolute;
right:5px; top:15px
}
.top-left {
position: absolute;
width:40%
}
.content {
text-align: center;
}
.title {
font-size: 84px;
}
.links > a {
color: #636b6f;
padding: 0 25px;
font-size: 12px;
font-weight: 600;
letter-spacing: .1rem;
text-decoration: none;
text-transform: uppercase;
}
.m-b-md {
margin-bottom: 30px0;
}
.head_har{
background-color: #f6f7f9;
border-bottom: 1px solid #dddfe2;
border-radius: 2px 2px 0 0;
font-weight: bold;
padding: 8px 6px;
}
.left-sidebar, .right-sidebar{
background-color:#fff;
height:600px;
}
.posts_div{margin-bottom:10px !important;}
.posts_div h3{
margin-top:4px !important;
}
#postText{
border:none;
height:100px
}
.likeBtn{
color: #4b4f56; font-weight:bold; cursor: pointer;
}
.left-sidebar li { padding:10px;
border-bottom:1px solid #ddd;
list-style:none; margin-left:-20px}
.dropdown-menu{min-width:120px; left:-30px}
.dropdown-menu a{ cursor: pointer;}
.dropdown-divider {
height: 1px;
margin: .5rem 0;
overflow: hidden;
background-color: #eceeef;}
.user_name{font-size:18px;
font-weight:bold; text-transform:capitalize; margin:3px}
.all_posts{background-color:#fff; padding:5px;
margin-bottom:15px; border-radius:5px;
-webkit-box-shadow: 0 8px 6px -6px #666;
-moz-box-shadow: 0 8px 6px -6px #666;
box-shadow: 0 8px 6px -6px #666;}
#commentBox{
background-color:#ddd;
padding:10px;
width:99%; margin:0 auto;
background-color:#F6F7F9;
padding:10px;
margin-bottom:10px
}
#commentBox li { list-style:none; padding:10px; border-bottom:1px solid #ddd}
.commet_form{ padding:10px; margin-bottom:10px}
.commentHand{color:#337ab7;}
.commentHand:hover{curs v-model=""r:pointer}
.upload_wrap{
position:relative;
display:inline-block;
}
.center-con{
max-height:600px;
position: absolute;
left:calc(25%);
overflow-y: scroll;
}
@media (min-width: 268px) and (max-width: 768px) {
.center-con{
max-height:600px;
position: relative;
left:0px;
overflow-y: scroll;
}
}


#box{
    margin-top: 5px;
    	border: 1px solid #3B5998;
        padding: 0.25px 10px;
        color: #3B5998;
        font-size: 25px;
        font-weight: bold;
        background: white ;
        text-decoration: none;
    }



</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>

<div id="app">
<div class="top_bar">

<div class="top-left links" style="float:left">

                <input type="text" class="form-control" 
                placeholder="Search" style="margin-left: 150px;" 
                v-model="qry" v-on:Keyup="autoComplete"/>

                <div class="input-group-btn" style="position:relative; top:-34.2px; right: -115px; border:none; float:right;">
                  <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                </div>
    
          
                
        <div v-if="results.length&&qry.length>0" class="panel-footer" style="transform:translate(30.5%,0); position:relative; z-index:1000;   border:1px solid #ccc;
            background:#fff; width: 496px; overflow-y:scroll; max-height: 260px;">
        
            <ul style="list-style-type:none;" v-for="result in results">
                <li>
                    <img :src="'{{url('../')}}/img/' +  result.pic" style="width:30px; border-radius:100%; margin: 5px;">    
                    <a :href="'{{url('profile')}}/' +  result.slug">
                    <b>@{{result.name}} </b>
                    </a>
                </li>
            </ul>
        </div>
        

</div>

<div class="top-right links" style="float:right">
@if (Auth::check())
<a href="{{url('/jobs')}}" style="background-color:#283E4A;
color:#fff; padding:5px 15px 5px 15px; border-radius:5px">Find Job</a>
<a href="{{ url('/home') }}">Dashboard (
<span style="text-transform:capitalize;
color:green">{{ucwords(Auth::user()->name)}}</span>)</a>
<a href="{{ url('/logout') }}">Logout</a>
@else
<a href="{{ url('/login') }}">Login</a>
<a href="{{ url('/register') }}">Register</a>
@endif
</div>

</div>


<div class="flex-center position-ref full-height">

<div class="col-md-12 ">
@if(Auth::check())
<!-- left side start -->
<div class="col-md-3 left-sidebar hidden-xs hidden-sm" style="position:fixed; left:10px">

    <ul>
    <li>
    <a href="{{ url('/profile') }}/{{Auth::user()->slug}}"> <img src="{{url('../')}}/img/{{Auth::user()->pic}}"
    width="32" style="margin:5px; border-radius: 50%;"  />
    {{Auth::user()->name}}</a>
    </li>
    <li>
    <a href="{{url('/')}}"> <img src="{{url('../')}}/img//news_feed.png"
    width="32" style="margin:5px"  />
    News Feed</a>
    </li>
    <li>
    <a href="{{url('/friends')}}"> <img src="{{url('../')}}/img//friends.png"
    width="32" style="margin:5px"  />
    Friends </a>
    </li>
    <li>
    <a href="{{url('/messages')}}"> <img src="{{url('../')}}/img//msg.png"
    width="32" style="margin:5px"  />
    Messages</a>
    </li>
    <li>
    <a href="{{url('/findFriends')}}"> <img src="{{url('../')}}/img//friends.png"
    width="32" style="margin:5px"  />
    Find Friends</a>
    </li>

    <li>
    <a href="{{url('/jobs')}}"> <img src="{{url('../')}}/img//jobs.png"
    width="32" style="margin:5px"  />
    Find Jobs</a>
    </li>
    </ul>


</div>
<!-- left side end -->


<!--center start -->

<div class="col-md-6 col-sm-12 col-xs-12 center-con">

    <div class="posts_div">
    <div class="head_har">
    <i class="fa fa-edit"></i> @{{msg}}
    </div>

    <div style="background-color:#fff; padding:10px">
    <div class="row">
    <div class="col-md-1 col-sm-2 pull-left">
    <img src="{{url('../')}}/img/{{Auth::user()->pic}}" class="img-circle"
    style="width:40px;">
    </div>

    <div class="col-md-11 col-sm-10 pull-right" id="post-box">
    <div>
    <div v-if="!image">
<form method="post" enctype="multipart/form-data" v-on:submit.prevent="addPost">
<textarea v-model="content" id="postText" class="form-control" placeholder="Write something here ... "></textarea>
            <button type="submit" class="btn btn-sm btn-primary
                pull-right" style="margin:10px; padding:5 15 5 15; background-color:#4267b2" id="postBtn">Post</button>
        </form>
                
    </div>

    <div v-if="!image" style="position:relative;display:inline-block; margin-top: 10px;">

        <div style="border:1px solid #ddd; border-radius:10px;
        background-color:#efefef; margin-bottom:10px">
        <div style="padding:2px 10px;">
            <img src="https://image.ibb.co/eHmOvU/uploadimage2.png" height="20px" width="20px" style="border-radius:20px;"> <b> &nbsp;Photo</b>
            <input type="file" @change="onFileChange" style="position:absolute;
            left:0;top:0; opacity:0"/>
        
        </div>
        </div>
    </div>

    <div v-else>

    <div class="upload_wrap">
        <div style="margin-bottom: 10px;">

<textarea  v-model="content" id="postText" class="form-control"
placeholder="Write something here ... " style="margin: 0px; width: 542px; height: 99px;">
        </textarea>
            
        </div>
        
        <div>
            <b @click="removeImg" style="right:0;position:absolute;cursor:pointer">Cancel</b>

            <img :src="image" id="imagepost" style="display:inline-block; width:200px; height:150px; margin:10px; border: 3px dotted #ddd; position:relative;"/><br>
        
        </div>
    </div>

    <button @click="uploadImg"  class="btn btn-sm btn-primary
    pull-right" style="margin:10px; padding:5 15 5 15; background-color:#4267b2">Post</button>

    </div>

    </div>

    {{-- <button class="btn btn-sm btn-info pull-right" style="margin:10px">Post</button> --}}

    </div>
    </div>
    </div>
    </div>

    <div class="posts_div">
    <div class="head_har">  Posts</div> 

    <div v-for="post,key in posts" >

    <div class="col-md-12 col-sm-12 col-xs-12 all_posts" style="background-color: #fff">

    <div class="col-md-1 pull-left">
    <img :src="'{{url('../')}}/img/' + post.user.pic"
    style="width:50px; border-radius:100%; margin: 5px;">
    </div>

    <div class="col-md-10" style="margin-left:10px;">
    <div class="row">
    <div class="col-md-11">

    <p><a :href="'{{url('profile')}}/' +  post.user.slug" class="user_name"> @{{post.user.name}}</a> <br>
    <span style="color:#AAADB3">  @{{ post.created_at | myOwnTime}}
    <i class="fa fa-globe"></i></span></p>
    </div>

    <div class="col-md-1">

    <!-- delete button goes here -->
    <a href="#" data-toggle="dropdown"
    style="font-size:20px; color:#ccc; left:-20px"
        aria-haspopup="true">...</a>

    <div class="dropdown-menu">
        <li>
            <a data-toggle="modal" :data-target="'#myModal' + post.id" @click="openModal(post.id)">Edit</a></li>
        <li><a>some more action</a></li>
        <div class="dropdown-divider"></div>
        <li v-if="post.user_id == '{{Auth::user()->id}}'">
            <a @click="deletePost(post.id)">
            <i class="fa fa-trash"></i> Delete</a>
        </li>
    </div>


    <div class="modal" :id="'myModal'+ post.id"  role="dialog" aria-hidden="true">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Post</h4>
            </div>
            <div class="modal-body">
                    <textarea v-model="updatedContent"
                    class="form-control">@{{post.content}}</textarea>
                  </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                data-dismiss="modal">Close</button>

                <button type="button" class="btn btn-success"
                data-dismiss="modal">Save Changes</button>
            </div>
            </div>

        </div>
    </div>


</div>



    <p class="col-md-12" style="color:#000; margin-top:15px; font-family:inherit">
    @{{post.content}}
    <br><br><br>
    <p>
    <img v-if="post.image" :src="'{{url('../')}}/img/' + post.image" style="width:100%"/>
    </p>

    </p>

    <div style="padding:10px; border: 1px solid #ddd" class="col-md-12">

    {{-- <div v-for="like in likes">
        <div v-if="post.id==like.posts_id && like.user_id=='{{Auth::user()->id}}'">
            
            <p class="likeBtn" @click="likePost(post.id)">
                <i class="fa fa-thumbs-up">
                    Liked by you
                </i>
            </p>
        </div>
        <div v-else>

        </div>
        </div> --}}

        {{-- <div class="col-md-4">

        <p v-if="post.likes.length>0">
        </p>

        <p v-if="post.likes.length>0">
        <div v-for="like in likes">
        <p v-if="post.like.user_id != '{{Auth::user()->id}}' ">
        <i class="fa fa-thumbs-up likeBtn" @click="likePost(post.id)">&nbsp;Like</i>
        </p>
        </div>
                        
        </p>

        <p v-if="post.likes.length==0">
        <i class="fa fa-thumbs-up likeBtn" @click="likePost(post.id)">&nbsp;Like</i>
        </p>
            

    </div> --}}

        <div class="col-md-4">
                <span v-if="post.likes.length>0">
                    <span style="color:white; background: #0099FF; border-radius:50%;" class="badge badge-success"><i class="fa fa-thumbs-up"></i> </span> @{{post.likes.length}} 
                </span>

                &nbsp;&nbsp;
                <span v-if="">
                <i onclick="liked()" id="likeBtn" class="fa fa-thumbs-up likeBtn" @click="likePost(post.id)">Like</i>
                </span>
        </div>

        <div class="col-md-4">
        <p class="commentHand" @click="commentSeen=!commentSeen" id="showComment" > <b> Comments @{{post.comments.length}}</b>  </p>
        </div>

    </div>
    </div>

    <br>

    <div id="commentBox" v-if="commentSeen">
    <div class="commet_form">
    <!-- send comment-->
        <div class="col-md-9">
    <textarea rows="1" cols="9" class="col-md-8 form-control" id="commentarea" placeholder="Write a comment..." 
    v-model="commentData[key]"  
                style=" border:1px solid #f1f1f1; background:#f2f2f2;  outline: none;border-radius: 50px; user-select: text; white-space: pre-wrap; word-wrap: break-word;">
                </textarea>    
        </div> 
        <div class="col-md-3">
                <button @click="addComment(post, key)" style="padding: 5px 10px;" class="btn btn-primary">Comment</button>        
        </div>
    </div>
    <br><br><br><br>    
    <ul v-for="comment in post.comments">
    <li>
        <img :src="'{{url('../')}}/img/' + comment.user_pic" style="width:30px; margin-bottom: 10px; border-radius:100%; margin-left:5px"
        class="pull-left">
    <a :href="'{{ url('/profile') }}/' + comment.user_name"> <b class="pull-left" style="margin-left:8px; margin-right: 5px;"> @{{comment.user_name}} </b> </a>   
        <span style="background: #e9ebee; border-radius: 50px; padding: 5px 10px; margin-bottom: 7px;">
                @{{comment.comment}}
        </span>
    </li>

    </ul>
    </div>
        



    </div>

    </div>
    <br>
    </div>
    </div>

</div>


<!--center end -->

<!-- right side start -->
<div class="col-md-3 right-sidebar hidden-sm hidden-xs" style="position:fixed; right:10px">
    <h3 align="center">Right Sidebar</h3>
    <?php $onlineusers = App\user::all()
    ?>

    @if(Auth::check())
        <?php 
            foreach($onlineusers as $user)
                if($user->isOnline()){ ?>
                    <img src="{{url('../')}}/img/{{ $user->pic}}" width="30px" height="30px" class="img-circle"> <?php ?> <a href="profile/{{ $user->slug }}"> <?php echo $user->name."</a><br><hr>";
                } ?>
    @endif



</div>

@else
<h1 align="center">Please login</h1>
@endif
</div>
</div>
</div>


</body>
</html>
<script>



    function liked(){
    $("likeBtn").on('click', function(){
	    $(this).text('Unlike');
    });
}




$(document).ready(function(){

//  var fileref = document.createElement('script');
//         fileref.setAttribute("type","text/javascript");
//         fileref.setAttribute("src","https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js");
//     document.body.appendChild(fileref);

// setTimeout(function(){
//     $('#postText').emojioneArea({
//     pickerPosition: "bottom",
//     toneStyle: "bullet"
// });

// }, 1000);




$('#postBtn').hide();
$("#postText").mouseenter(function() {
$('#postBtn').show();
});

$("#postBtn").on('click', function(){
$("#postText").val('');
})

$("#post-box").mouseout(function(){
setTimeout(function(){
$('#postBtn').hide();
}, 5000);     

});




// $("#postText").animate({
// 'zoom' : currentZoom += .5
// }, 'slow');

});

</script>