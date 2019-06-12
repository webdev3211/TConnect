

<div class="col-md-3 left-sidebar" style="background-color:#fff;height:600px;">
    <div class="panel panel-default">
        <div class="panel-heading">Sidebar - Quick Links</div>
        <br>
        @if(Auth::check())
        <ul style="list-style-type:none">
            <li>
            <a href="{{ url('/profile') }}/{{Auth::user()->slug}}"> <img src="{{url('../')}}/img/{{Auth::user()->pic}}"
            width="32" style="margin:5px; border-radius: 50%;"  />
            {{Auth::user()->name}}</a>
            </li>
            <hr style="margin: 5px;">

            <li>
            <a href="{{url('/')}}"> <img src="{{url('../')}}/img//news_feed.png"
            width="32" style="margin:5px"  />
            News Feed</a>
            </li>
            <hr style="margin: 5px;">
            <li>
            <a href="{{url('/friends')}}"> <img src="{{url('../')}}/img//friends.png"
            width="32" style="margin:5px"  />
            Friends </a>
            </li>
            <hr style="margin: 5px;">
            <li>
            <a href="{{url('/messages')}}"> <img src="{{url('../')}}/img//msg.png"
            width="32" style="margin:5px"  />
            Messages</a>
            </li>
            <hr style="margin: 5px;">
            <li>
            <a href="{{url('/findFriends')}}"> <img src="{{url('../')}}/img//friends.png"
            width="32" style="margin:5px"  />
            Find Friends</a>
            </li>
            <hr style="margin: 5px;">
            
            <li>
            <a href="{{url('/jobs')}}"> <img src="{{url('../')}}/img//jobs.png"
            width="32" style="margin:5px"  />
            Find Jobs</a>
            </li>
            <hr style="margin: 5px;">
            </ul>
            
           @endif
    </div>
</div>