<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCommentRequest;
use App\Http\Requests\EditCommentRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function add_comment(AddCommentRequest $request){
        $comment=Comment::create([
            'project_id' => $request->project_id,
            'user_id' => Auth::user()->id,
            'text' => $request->comment,
        ]);
        $comment->user;
        $comment->replies=$comment->replies()->get();
        return response()->json($comment);
    }

    public function delete_comment($id){
        $comment=Comment::find($id);
        if($comment->user_id===Auth::user()->id){
            $comment->replies()->delete();
            $comment->delete();
        }
        return response()->json();
    }

    public function edit_comment(EditCommentRequest $request){
        $comment=Comment::find($request->comment_id);
        if($comment->user_id===Auth::user()->id) {
            $comment->text = $request->text;
            $comment->save();
        }
        return response()->json();
    }
}
