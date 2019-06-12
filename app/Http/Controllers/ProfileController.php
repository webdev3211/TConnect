<?php

namespace App\Http\Controllers;

use Auth;   
use App\arefriends;
use App\friendships;
use App\notifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index($slug){

        $userData = DB::table('users')
        ->leftJoin('profiles', 'profiles.user_id', 'users.id')
        ->where('slug', $slug)
        ->get();
    
        return view('profile.index', compact('userData'));
    }

    public function uploadPhoto(Request $request){

        //to check what gets uploaded use 
        //dd($request->all());

        $file = $request->file('pic');
        $filename = $file->getClientOriginalName();
        
        $path = 'img/';

        $file->move($path, $filename);
        $user_id = Auth::user()->id;    

        //Query Builder
        DB::table('users')->where('id', $user_id)->update([
            'pic' => $filename
        ]);
        
        return back();
        // $slug = Auth::user()->slug;
        // return redirect('/profile/{$slug}');

    }

    public function setToken(Request $request){

        $email = $request->email_address;

        ///check if any user have this email address
        $checkEmail = DB::table('users')
        ->where('email', $email)->get();

        if(count($checkEmail) == 0){
            echo 'Wrong Email address';
        } else{

            

        }


    }


    public function editProfileForm(){
        return view('profile.editProfile')->with('data', Auth::user()->profile);
    }


    public function updateProfile(Request $request){

        $user_id = Auth::user()->id;
        DB::table('profiles')->where('user_id', $user_id)->update($request->except('_token'));
        return back();        
    }

    public function findFriends() {
        $uid = Auth::user()->id;
        $allUsers = DB::table('profiles')
        ->leftJoin('users', 'users.id', '=', 'profiles.user_id')
        ->where('users.id', '!=', $uid)->get();
        return view('profile.findFriends', compact('allUsers'));
    }

    public function sendRequest($id) {
        Auth::user()->addFriend($id);
        return back();
    }

    public function requests(){

        $uid = Auth::user()->id;

        $FriendRequests = DB::table('friendships')
            ->rightJoin('users', 'users.id', '=', 'friendships.requester')
            ->where('status', 0) //if status 0 then i have request else 1 for accept
            ->where('friendships.user_requested', '=', $uid)->get(); //jisne loginned person ko request bheja hh


        return view('profile.requests', compact('FriendRequests'));
    }

    public function accept($name, $id){
        //echo $id;
        $uid = Auth::user()->id;
        $checkRequest = friendships::where('requester', $id)
                ->where('user_requested', $uid)
                ->first();
        if ($checkRequest) {
            // echo "yes, update here";
            $updateFriendship = DB::table('friendships')
                    ->where('user_requested', $uid)
                    ->where('requester', $id)
                    ->update(['status' => 1]);

            $createfriends = new arefriends;
            $createfriends->user_one = $uid;
            $createfriends->user_two = $id;
            $createfriends->status = '1';
            $createfriends->save();

            $createfriends = new arefriends;
            $createfriends->user_one = $id;
            $createfriends->user_two = $uid;
            $createfriends->status = '1';
            $createfriends->save();

            $notifications = new notifications;
            $notifications->note = 'accepted your friend request';
            $notifications->user_hero = $id; // who is accepting my request
            $notifications->user_logged = Auth::user()->id; // me
            $notifications->status = '1'; // unread notifications
            $notifications->save();


            if($notifications){
                return back()->with('msg', 'You are now friend with '.$name);
            }

        }else{
            return back()->with('msg', 'Something went wrong');
        }

    }


    public function friends() {
        $uid = Auth::user()->id;
        $friends1 = DB::table('friendships')
                ->leftJoin('users', 'users.id', 'friendships.user_requested') // who is not loggedin but send request to
                ->where('status', 1)
                ->where('requester', $uid) // who is loggedin
                ->get();
        //dd($friends1);
        $friends2 = DB::table('friendships')
                ->leftJoin('users', 'users.id', 'friendships.requester')
                ->where('status', 1)
                ->where('user_requested', $uid)
                ->get();
        $friends = array_merge($friends1->toArray(), $friends2->toArray());
        return view('profile.friends', compact('friends'));
    }


    public function requestRemove($id){

        $uid = Auth::user()->id;
        
        DB::table('friendships')
            ->where('user_requested', $uid)
            ->where('requester', $id)
            ->delete();

        return back()->with('msg-deleted', 'Request has been deleted');

    }

    public function notifications($id){

        $notes = DB::table('users')
        ->leftJoin('notifications', 'users.id', 'notifications.user_logged')
        ->where('notifications.id', $id)
        ->where('user_hero', Auth::user()->id)
        ->orderBy('notifications.created_at', 'desc')
        ->get();

        //mark as read
        $updateNoti = DB::table('notifications')
        ->where('notifications.id', $id)
       ->update(['status' => 0]);


        return view('profile.notifications', compact('notes'));

    }

  
    public  function sendMessage(Request $request){
        $conID = $request->conID;
        $msg = $request->msg;
        $checkUserId = DB::table('messages')
        ->where('conversation_id', $conID)
        ->get();
        if($checkUserId[0]->user_from== Auth::user()->id){
          // fetch user_to
          $fetch_userTo = DB::table('messages')->where('conversation_id', $conID)
          ->get();
            $userTo = $fetch_userTo[0]->user_to;
        }else{
        // fetch user_to
        $fetch_userTo = DB::table('messages')->where('conversation_id', $conID)
        ->get();
          $userTo = $fetch_userTo[0]->user_to;
        }
          // now send message
          $sendM = DB::table('messages')->insert([
            'user_to' => $userTo,
            'user_from' => Auth::user()->id,
            'msg' => $msg,
            'status' => 1,
            'conversation_id' => $conID
          ]);

          $update_status = DB::table('conversation')
          ->where('id', $conID)
          ->update([
              'status' => 1 //now read by user
          ]);

          if($sendM){
            $userMsg = DB::table('messages')
            ->join('users', 'users.id','messages.user_from')
            ->where('messages.conversation_id', $conID)->get();
            return $userMsg;
          }
      }


    public function newMessage(){
        $uid = Auth::user()->id;
        $friends1 = DB::table('friendships')
                ->leftJoin('users', 'users.id', 'friendships.user_requested') // who is not loggedin but send request to
                ->where('status', 1)
                ->where('requester', $uid) // who is loggedin
                ->get();
        $friends2 = DB::table('friendships')
                ->leftJoin('users', 'users.id', 'friendships.requester')
                ->where('status', 1)
                ->where('user_requested', $uid)
                ->get();
        $friends = array_merge($friends1->toArray(), $friends2->toArray());
        return view('newMessage', compact('friends', $friends));
      }

      public function sendNewMessage(Request $request){
        $msg = $request->msg;
        $friend_id = $request->friend_id;
        $myID = Auth::user()->id;
        //check if conversation already started or not
        $checkCon1 = DB::table('conversation')->where('user_one',$myID)
        ->where('user_two',$friend_id)->get(); // if loggedin user started conversation
        $checkCon2 = DB::table('conversation')->where('user_two',$myID)
        ->where('user_one',$friend_id)->get(); // if loggedin recviced message first
        $allCons = array_merge($checkCon1->toArray(),$checkCon2->toArray());
        
        if(count($allCons)!=0){
          // old conversation
          $conID_old = $allCons[0]->id;


        //   $update_status = DB::table('conversation')
        //   ->where('id', $conID_old)
        //   ->update([
        //       'status' => 1 //now read by user
        //   ]);

          //insert data into messages table
          $MsgSent = DB::table('messages')->insert([
            'user_from' => $myID,
            'user_to' => $friend_id,
            'msg' => $msg,
            'conversation_id' =>  $conID_old,
            'status' => 1
          ]);
        }else {
          // new conversation
          $conID_new = DB::table('conversation')->insertGetId([
            'user_one' => $myID,
            'user_two' => $friend_id,
          ]);
          echo $conID_new;

        //   $update_status = DB::table('conversation')
        //   ->where('id', $conID_new)
        //   ->update([
        //       'status' => 1 //now read by user
        //   ]);

          $MsgSent = DB::table('messages')->insert([
            'user_from' => $myID,
            'user_to' => $friend_id,
            'msg' => $msg,
            'conversation_id' =>  $conID_new,
            'status' => 1
          ]);
        }
    }


    public function jobs(){
        $jobs = DB::table('jobs')->get();
        return view('profile.jobs', compact('jobs'));
    }

    public function job($id){
        $jobs = DB::table('jobs')
        ->where('id', $id)
        ->get();
        return view('profile.jobs', compact('jobs'));
    }

    

}
