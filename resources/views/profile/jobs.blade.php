@extends('profile.master')
@section('content')

<div class="container">

<ol class="breadcrumb">
<li><a href="{{url('/home')}}">Home</a></li>
<li><a href="{{url('/profile')}}/{{Auth::user()->slug}}">Profile</a></li>
<li><a href="">Jobs</a></li>
</ol>


<div class="row">
@include('profile.sidebar')


<div class="col-md-9">
<div class="panel panel-default">
<div class="panel-heading"><h4><span style="color:green">{{ucwords(Auth::user()->name)}}</span>, Jobs you may be interested in</h4>Any location Selected industries:  Any industry Selected company size range:  1 to 1,000 employees         </div>

<div class="panel-body">
    @if ( session()->has('msg') )
    <p class="alert alert-success">
                {{ session()->get('msg') }}
            </p>
        @endif
@foreach($jobs as $job)
<div class="jobDiv">
<a href="{{url('job')}}/{{$job->id}}">
<img src="{{ url('/') }}/img/job.jpg" class="img-circle" style="width:50px;height:50px;" >
<div class="caption">
<li><i class="fa fa-briefcase" aria-hidden="true"></i> {{$job->job_title}} </li>

<li><i class="fa fa-building-o" aria-hidden="true"></i> {{ucwords($job->job_title)}}</li>
</a>
        <li> <?php $skills = explode(',',$job->skills)?>
        @foreach($skills as $skill)
            <div style="margin-right:10px; background-color:tomato; color:#fff; padding: 10px 15px; margin-top:5px; border-radius:10px; width:100%; float:left;">{{$skill}}</div>

        @endforeach
            <a href="{{url('job')}}/{{$job->id}}" style="margin-top:10px; width:100%" class="btn btn-primary">View details</a>
        </li>
        <br><br><hr>
        </div>
    </div>




@endforeach
</div>

</div>
</div>
</div>
</div>
</div>
@endsection