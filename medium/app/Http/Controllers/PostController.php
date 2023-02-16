<?php

namespace App\Http\Controllers;

use App\Http\Requests\LikeRequest;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Http\Requests\UnlikeRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $posts = Post::with('user')
            ->with('categories')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('posts.index', compact('posts', 'categories'));
    }

    /**
     * Display a listing of posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAllPosts()
    {
        $categories = Category::all();

        $posts = Post::with('categories')
            ->filter(request('search'))
            ->latest('created_at')
            ->paginate(10);

        $latest = Post::with('categories')
            ->latest('created_at')
            ->take(3)
            ->get();

        return view('posts.index', compact('posts', 'categories', 'latest'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created posts in storage.
     *
     * @param  \Illuminate\Http\PostStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(storage_path('app/public/images'), $imageName);
        $post = Post::create([
            'user_id' => auth()->id(),
            'image' => $imageName,
            'title' => $request->title,
            'description' => $request->description,
        ]);
        $post->categories()->sync($request->category);

        return redirect()->route('lists')->with('success', 'A Post Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts = Post::with('comments')->where('id', $id)->get();

        return view('posts.show', compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $post = Post::findOrFail($post->id);

        if (empty($post) || auth()->id() != $post->user_id) {

            abort(403);
        } else {

            return view('posts.edit', compact('categories', 'post'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\PostUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, Post $post)
    {

        if ($request->file('image')) {
            unlink(storage_path('app/public/images/') . $post->image);
            $imageName = time() . '.' . $request->file('image')->extension();

            // Storage Folder
            $request->image->move(storage_path('app/public/images'), $imageName);
            $post->image = $imageName;
        }
        $post->user_id = auth()->id();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->categories()->sync($request->category);
        $post->save();

        return redirect()->route('lists')->with('info', 'A Post Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

        unlink(storage_path('app/public/images/') . $post->image);
        $post->categories()->sync([]);
        $post->delete();

        return redirect()->route('lists')->with('warning', 'A Post Deleted Successfully');
    }

    /**
     * Summary of relatedPosts
     * @param mixed $post_id
     * @return mixed
     */
    public function relatedPosts($category_id)
    {
        $currentCategory = Category::find($category_id);
        $categories = $currentCategory->get();

        $posts = $currentCategory->posts()->paginate(10);

        $latest = Post::with('categories')
            ->filter(request('search'))
            ->latest('created_at')
            ->take(3)
            ->get();

        return view('category.show', compact('posts', 'categories', 'latest'));

    }

    public function like(LikeRequest $request)
    {
        $request->user()->like($request->likeable());

        if ($request->ajax()) {

            return response()->json([
                'likes' => $request->likeable()->likes()->count(),
            ]);
        }

        return redirect()->route('lists');
    }

    public function unlike(UnlikeRequest $request)
    {
        $request->user()->unlike($request->likeable());

        if ($request->ajax()) {

            return response()->json([
                'likes' => $request->likeable()->likes()->count(),
            ]);
        }

        return redirect()->back();
    }
}