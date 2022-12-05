<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::with('userFrom')->where('user_id_to',Auth::id())->notDeleted()->get();
        return view('home')->with('messages',$messages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(int $id = 0, String $subject = '')
    {
        if($id == 0)
        {
            $users = User::where('id','!=',Auth::id())->get();
        }
        else
        {
            $users = User::where('id',$id)->get();
        }
       
        if($subject != '') $subject = 'Re ' . $subject;

        return view('create')->with(['users'=>$users, 'subject'=>$subject]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validate($request,[
        'subject' => ['required'],
        'body'  => ['required'],

       ]);

       $message = new Message();
       $message->user_id_from = Auth::id();
       $message->user_id_to = $request->input('to');
       $message->subject = $request->input('subject');
       $message->body = $request->input('body');

       $message->save();


       return redirect()->to('/home')->with('success','Message has sent successfully');

    }

    public function sent()
    {
        $messages = Message::with('userTo')->where('user_id_from', Auth::id())->orderBy('created_at','desc')->get();
        return view('sent')->with('messages',$messages);
    }

    public function read(Request $request, int $id)
    {
        $message = Message::with('userFrom')->find($id);
        $message->read = true;
        $message->save();
        return view('read')->with('message',$message);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function delete(int $id)
    {
        $message = Message::find($id);

        $message->deleted = true;
        $message->save();

        return redirect()->to('/home')->with('status','Message has been deleted successfully');
    }

    public function deleted()
    {
        $messages = Message::with('userFrom')->where('user_id_to',Auth::id())->Deleted()->get();
        return view('deleted')->with('messages',$messages);
    }

    public function return(int $id)
    {
        $message = Message::find($id);
        $message->deleted = false;
        $message->save();

        return redirect()->to('/home')->with('status','Message has been restored successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
