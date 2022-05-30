<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class PostController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('ManagePost');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:191',
            'description' => 'required|string|max:500',
        ]);

        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->user()->id
        ]);

        Session::flash('alertSuccess', 'Successfully created a post!');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Inertia\Response
     */
    public function show(Request $request, Post $post)
    {
        $post->loadMissing('user');
        $can = [
            'edit' => $request->user()->can('update', $post),
            'destroy' => Gate::forUser(auth()->user())->allows('delete', $post),
        ];

        return Inertia::render('ViewPost', ['post' => $post, 'can' => $can]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Inertia\Response
     */
    public function edit(Post $post)
    {
        return Inertia::render('ManagePost', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Post $post)
    {
        $new_post = $request->validate([
            'title' => 'required|string|max:191',
            'description' => 'required|string|max:500',
        ]);

        $post->update($new_post);

        return redirect()->to(route('post.show', $post->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post)
    {
        $post->deleteOrFail();

        return redirect()->to(route('dashboard'));
    }
}
