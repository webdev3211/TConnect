<?php


Route::post('search', 'PostsController@search');

//Password Reset routes
Route::get('password/email', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');


Route::post('setToken', 'ProfileController@setToken');


Route::get('newMessage','ProfileController@newMessage');
Route::post('sendNewMessage', 'ProfileController@sendNewMessage');

Route::post('/sendMessage', 'ProfileController@sendMessage');


Route::get('/messages', function(){
    return view('messages');
});


Route::get('/getMessages', function(){
    $allUsers1 = DB::table('users') //who sent msg to me
    ->Join('conversation','users.id','conversation.user_one')
    ->where('conversation.user_two', Auth::user()->id)->get();
    //return $allUsers1;
  
    $allUsers2 = DB::table('users') //to whom i sent msg
    ->Join('conversation','users.id','conversation.user_two')
    ->where('conversation.user_one', Auth::user()->id)->get();
  
    return array_merge($allUsers1->toArray(), $allUsers2->toArray());
});


Route::get('/getMessages/{id}', function($id){
    // $checkCon = DB::table('conversation')
    // ->where('user_one', Auth::user()->id )
    // ->where('user_two', $id)->get();

    // if(count($checkCon)!=0){

    //     $userMsg = DB::table('messages')
    //     ->where('messages.conversation_id', $checkCon[0]->id)
    //     ->get();
    
    //     return $userMsg;

    // } else{
    //      echo 'No Messgaes';
    // }
    $update_status = DB::table('conversation')
    ->where('id', $id)
    ->update([
        'status' => 0 //now read by user
    ]);

    $userMsg = DB::table('messages')
    ->join('users', 'users.id', 'messages.user_from')
    ->where('messages.conversation_id', $id)->get();
    
    return $userMsg;
});


Route::get('/', function () {
//     $posts = DB::table('posts')
// ->leftJoin('profiles', 'profiles.user_id', 'posts.user_id')
//     ->leftJoin('users', 'users.id', 'posts.user_id')
//     ->orderBy('posts.created_at', 'desc')->take(5)
//     ->get();
    $posts = App\post::with('user', 'likes', 'comments')
    ->orderBy('created_at', 'DESC')
    ->get();
    return view('welcome',compact('posts'));
    
    
});


Route::get('/posts', function(){
    // $posts_json = DB::table('posts')
    // ->leftJoin('profiles', 'profiles.user_id', 'posts.user_id')
    // ->leftJoin('users', 'users.id', 'posts.user_id')
    // ->orderBy('posts.created_at', 'desc')->take(5)
    // ->get();

    // return $posts_json;

    return App\post::with('user', 'likes' , 'comments')
    ->orderBy('created_at', 'DESC')
    ->get();
    
});

Route::get('posts/{id}', function($id){
     $pData = App\post::where('id', $id)->get();
     echo $pData[0]->content; 
});



Route::get('/count', function(){
    $count = App\notifications::where('status', 1) //unread
                ->where('user_hero', Auth::user()->id)->count();

    echo $count;
});

Route::get('/profile/{slug}', 'ProfileController@index');

Route::get('/likes', function(){
    return App\likes::all();
});

Route::get('/', function(){
    $likes = App\likes::all();
    return view('welcome', compact('likes'));
});

Auth::routes();


Route::group( ['middleware' => 'auth'], function(){
   
    Route::post('/addPost', 'PostsController@addPost');
    
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/changePhoto', function(){
        return view('profile.pic');
    });

    Route::post('/uploadPhoto', 'ProfileController@uploadPhoto');

    Route::get('editProfile', 'ProfileController@editProfileform');

    Route::post('/updateProfile', 'ProfileController@updateProfile');

    Route::get('/findFriends', 'ProfileController@findFriends');

    Route::get('/addFriend/{id}','ProfileController@sendRequest');
    
    Route::get('/requests', 'ProfileController@requests');

    Route::get('/accept/{name}/{id}', 'ProfileController@accept');

    Route::get('friends', 'ProfileController@friends');

    Route::get('/requestRemove/{id}', 'ProfileController@requestRemove');

    Route::get('/notifications/{id}', 'ProfileController@notifications');
    
    Route::get('/unfriend/{name}/{id}', function($name, $id){
        $loggedUser = Auth::user()->id;
        DB::table('friendships')
        ->where('requester', $loggedUser)
        ->where('user_requested', $id)
        ->delete();
        
        DB::table('friendships')
        ->where('user_requested', $loggedUser)
        ->where('requester', $id)
        ->delete();
        return back()->with('msg-unfriend', 'You are not friend with '.$name);
  
    });

    //jobs for user
    Route::get('jobs', 'ProfileController@jobs');

    Route::get('job/{id}', 'ProfileController@job');


    //delete post
    Route::get('/deletePost/{id}', 'PostsController@deletePost');

    //like post
    Route::get('/likePost/{id}', 'PostsController@likePost');
   
    //Add comments
    Route::post('addComment', 'PostsController@addComment');

    //save image
    Route::post('saveImg', 'PostsController@saveImg');

});

// Route::get('posts', 'HomeController@index');

Route::group( ['prefix' => 'company', 'middleware' => ['auth', 'company']], function(){

    Route::get('/', 'companyController@index');

    Route::get('/addJob', function(){
        return view('company.addJob');
    });

    Route::post('addJobSubmit', 'companyController@addJobSubmit');

    Route::get('/jobs', 'companyController@viewJobs');


});



Route::group( ['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function(){

    Route::get('/', 'adminController@index');
    
});

Route::get('/logout', 'Auth\LoginController@logout');
