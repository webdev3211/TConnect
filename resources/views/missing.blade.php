@extends('profile.master')

@section('content')

    <div class="container">
        <div class="row">
            <br><br>
            <div class="col-md-8 col-md-offset-2">
                <b>
                        <p  style="font-size:23px;" align="center">
                                This page isn't available
                        </p>
                        <p style="font-size:15px;" align="center">
                        The link you followed may be broken, or the page may have been removed.
                            
                        </p>
                    
                        <br>
                        <br>
                    <div class="col-md-offset-4">
                            <img src="https://image.ibb.co/gTbi3U/missing.png">
                        
                    </div>

                </b>

                <br>
                <hr>
                <div class="col-md-offset-5">
                    
                    <b>
                        <a href="#">Visit Our Help Center</a>                 
                    </b>
                </div>                
            </div>

        </div>
    </div>



@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<script>
$(document).ready(function(){
    document.body.style.backgroundColor = "white";
    $("#loginbtn").remove();
    $("#registerbtn").remove();
});

</script>

