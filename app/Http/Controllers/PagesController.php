<?php 

namespace App\Http\Controllers;

use App\DepartmentAccreditation;
use App\User;
use App\Agency;
use App\Message;
use App\ParameterFlag;
use App\FileFlag;
use Pusher\Pusher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    //
    public function ShowDepartment($id){
        $data = [
            'department_accreditation_list' => DepartmentAccreditation::where('agency_id',$id)->get(),
            //'faculty' => User::where('role_id', 2)->get(),
            'users' => DB::select("select users.id, users.first_name, users.last_name, users.profile_image, users.email, count(is_read) as unread 
        from users LEFT  JOIN  messages ON users.id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
        where users.id != " . Auth::id() . " 
        group by users.id, users.first_name, users.last_name, users.profile_image, users.email"),
        ];

        return view('pages.department')->with($data);
    }

    public function showRequestFile(){
        $data = [
            'request_files' => FileFlag::where('user', '!=', Auth::user()->id)->where('flag', '!=', 1)->get(),
            'users' => User::where('id', '!=', Auth::user()->id)->get(),
        ];
    	return view('pages.request_file')->with($data);
    }

    public function showRequestParameter(){
        $data = [
            'request_parameters' => ParameterFlag::where('user', '!=', Auth::user()->id)->where('flag', '!=', 1)->get(),
            'users' => User::where('id', '!=', Auth::user()->id)->get(),
        ];
    	return view('pages.request_parameter')->with($data);
    }

    // public function message(){
    // 	$data = [
    // 		'users' => User::where('id', '!=', Auth::user()->id)->get(),
    // 	];
    // 	return view('messages.messages')->with($data);
    // }

    public function Profile(){
        $data = [
            'users' => DB::select("select users.id, users.first_name, users.last_name, users.profile_image, users.email, count(is_read) as unread 
        from users LEFT  JOIN  messages ON users.id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
        where users.id != " . Auth::id() . " 
        group by users.id, users.first_name, users.last_name, users.profile_image, users.email"),
        ];
        return view('pages.profile')->with($data);
    }

    public function ProfilePicture(){
        $data = [
            'users' => DB::select("select users.id, users.first_name, users.last_name, users.profile_image, users.email, count(is_read) as unread 
        from users LEFT  JOIN  messages ON users.id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
        where users.id != " . Auth::id() . " 
        group by users.id, users.first_name, users.last_name, users.profile_image, users.email"),
        ];
        return view('pages.profile_pic')->with($data);
    }

    public function message(){

        $users = DB::select("select users.id, users.first_name, users.last_name, users.profile_image, users.email, count(is_read) as unread 
        from users LEFT  JOIN  messages ON users.id = messages.from and is_read = 0 and messages.to = " . Auth::id() . "
        where users.id != " . Auth::id() . " 
        group by users.id, users.first_name, users.last_name, users.profile_image, users.email");
        // $user = Auth::user()->id;
        // $data = array(
        //     'users' => User::all(),
        //     'chats' => Message::where('from', $user)->get(),
        //     'chats2' => Message::where('to', $user)->get(),
        //     //'request' => AccessArea::where('head', Auth::user()->id)->first()
        // );
        return view('messages.messenger', ['users' => $users]);
        // return view('messages.messenger')->with($data);
    }

    public function getMessage($user_id){
        //return $user_id;
        $my_id = Auth::id();

        // Make read all unread message
        Message::where(['from' => $user_id, 'to' => $my_id])->update(['is_read' => 1]);

        // Get all message from selected user
        $messages = Message::where(function ($query) use ($user_id, $my_id) {
            $query->where('from', $user_id)->where('to', $my_id);
        })->oRwhere(function ($query) use ($user_id, $my_id) {
            $query->where('from', $my_id)->where('to', $user_id);
        })->get();

        return view('messages.messages.index', ['messages' => $messages]);
    }

    public function sendMessage(Request $request){
    	$from = Auth::id();
        $to = $request->receiver_id;
        $message = $request->message;

        $data = new Message();
        $data->from = $from;
        $data->to = $to;
        $data->message = $message;
        $data->is_read = 0; // message will be unread when sending message
        $data->save();

        // pusher
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data = ['from' => $from, 'to' => $to]; // sending from and to user id when pressed enter
        $pusher->trigger('my-channel', 'my-event', $data);
    }
}
