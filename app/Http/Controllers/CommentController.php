<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required',
            'post_id' => 'required'
        ]);

        Comment::create([
            'content' => $request->comment,
            'post_id' => $request->post_id,
            'user_id' => auth()->user()->id
        ]);
        Session::flash('alertSuccess', 'Successfully commented on a post!');

        return redirect()->to(route('post.show', $request->post_id));
    }
}
