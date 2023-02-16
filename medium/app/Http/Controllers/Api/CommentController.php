<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comment = Comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $request->post_id,
            'body' => $request->body,
        ]);

        $comment = Comment::where('id', $comment->id)
            ->with("user")
            ->first();

        return response([
            'message' => 'success',
            'data' => $comment,
        ]);
    }

    public function show($id)
    {
        $comments = Comment::where('post_id', $id)
            ->with('user')
            ->orderBy('id', 'desc')
            ->get();

        return response()->json($comments);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response(200);
    }
}