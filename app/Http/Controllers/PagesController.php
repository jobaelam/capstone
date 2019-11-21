<?php

namespace App\Http\Controllers;

use App\DepartmentAccreditation;
use App\User;
use App\Agency;
use App\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function ShowDepartment($id){
        $data = [
            'department_accreditation_list' => DepartmentAccreditation::where('agency_id',$id)->get(),
            //'faculty' => User::where('role_id', 2)->get(),
        ];

        return view('pages.department')->with($data);
    }

    public function showRequestFile(){

    	return view('pages.request_file')->with($data);
    }

    public function showRequestParameter(){
        $request_parameters = ParameterFlag::all();
    	return view('pages.request_parameter')->with($data);
    }

    public function message(){
    	$data = [
    		'users' => User::where('id', '!=', Auth::user()->id)->get(),
    	];
    	return view('messages.messages')->with($data);
    }

    public function getMessage($user_id){
    	$my_id = Auth::id();
    	$messages = Message::where(function ($query) use ($user_id, $my_id){
    		$query->where('from', $my_id)->where('to', $user_id);
    	})->orWhere(function ($query) use ($user_id, $my_id){
    		$query->where('from', $user_id)->where('to', $my_id);
    	})->get();
    	return view('messages.messages.index', ['messages' => $messages]);
    }

    public function sendMessage(Request $request){
    	$from = Auth::id();
    	$to = $request->receiver_id;
    	$message = $request->message;

    	return $request->receiver_id;
    	// $data = new Message();
    	// $data->from = $from;
    	// $data->to = $to;
    	// $data->message = $message;
    	// $data->is_read = 0;
    	// $data->save();
    }
}
