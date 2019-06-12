

<form method="post" action="{{url('/')}}/setToken">

    @csrf

<input type="text" name="email_address">
<input type="submit" value="Send Reset Password Link">

</form>