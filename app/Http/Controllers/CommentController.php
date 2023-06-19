<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Files\Share;
use App\Models\Comment\Comment;
use App\Repositories\ShareRepository;

class CommentController extends Controller
{
    public function __construct(ShareRepository $shareservice)
    {
        $this->shareservice   = $shareservice;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'message' => 'required|string',
            'email' => 'nullable|email',
            'name' => 'required'
        ]);

        $comment = new Comment;

        $id = decryptId($request->share_id);

        $comment->comment    = $request->message;
        $comment->is_private = $request->is_private;
        $comment->name       = $request->name;
        $comment->email      = $request->email;

        if (\Auth::id())
        {
            $comment->user_id = \Auth::id();
        }

        $post = Share::find($id);

        $post->comments()->save($comment);

        $render = $this->shareservice->renderComment($comment->id);

        return response()->json(['success' => true,  'render' => $render]);
    }

    public function replyStore(Request $request)
    {
        $this->validate($request, [
            'message' => 'required|string',
            'email' => 'nullable|email'
        ]);

        $id = decryptId($request->share_id);

        $reply = new Comment();

        $reply->comment      = $request->message;
        $reply->is_private   = $request->is_private;
        $reply->name         = $request->name;
        $reply->email        = $request->email;
        $reply->parent_id    = $request->comment_id;

        if (\Auth::id())
        {
            $reply->user_id = \Auth::id();
        }

        $post = Share::find($id);

        $post->comments()->save($reply);

        $render = $this->shareservice->renderComment($request->comment_id);

        return response()->json(['success' => true,  'render' => $render, 'id' => $request->comment_id]);

        return back();

    }
}
