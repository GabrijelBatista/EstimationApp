<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddReplyRequest;
use App\Http\Requests\EditReplyRequest;
use App\Models\Reply;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    public function add_reply(AddReplyRequest $request){
        $reply=Reply::create([
            'comment_id' => $request->comment_id,
            'user_id' => Auth::user()->id,
            'text' => $request->reply,
        ]);
        $reply->user;

        return response()->json($reply);
    }

    public function delete_reply($id){
        $reply=Reply::find($id);
        if($reply->user_id===Auth::user()->id){
            $reply->delete();
        }
        return response()->json();
    }

    public function edit_reply(EditReplyRequest $request){
        $reply=Reply::find($request->reply_id);
        if($reply->user_id===Auth::user()->id) {
            $reply->text = $request->text;
            $reply->save();
        }
        return response()->json();
    }
}
