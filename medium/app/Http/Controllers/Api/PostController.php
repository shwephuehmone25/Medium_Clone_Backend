<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LikeRequest;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Http\Requests\UnlikeRequest;
use App\Models\Category;
use App\Models\CategoryPost;
use App\Models\Post;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{

    /**
     * Display a listing of posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAllPosts()
    {

        $posts = Post::with('categories')
            ->filter(request('search'))
            ->latest('created_at')
            ->paginate(10);

        return response()->json($posts, 200);
    }

    /**
     * Store a newly created posts in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {
        $imageName = time() . '.' . $request->image->extension();
        // Storage Folder
        $request->image->move(storage_path('app/public/images'), $imageName);
        $post = Post::create([
            'user_id' => auth()->id(),
            'image' => $imageName,
            'title' => $request->title,
            'description' => $request->description,
        ]);
        $post->categories()->sync($request->category);
        return response([
            'message' => 'A post created successsfully',
            'data' => $post,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts = Post::find($id);
        $categories = CategoryPost::where('post_id', $id)->pluck('category_id');

        return response()->json([
            'posts' => $posts,
            'categories' => $categories,
        ]);
    }

    /**
     * Store updated post in database.
     *
     * @param  \Illuminate\Http\PostRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        if ($request->file('image')) {
            if (File::exists(storage_path('app/public/images/') . $post->image)) {
                File::delete(storage_path('app/public/images/') . $post->image);
            }
            $imageName = time() . '.' . $request->file('image')->extension();

            // Storage Folder
            $request->image->move(storage_path('app/public/images'), $imageName);
            $post->image = $imageName;
        }
        $post->title = $request->title;
        $post->description = $request->description;
        $post->categories()->sync($request->category);
        $post->save();

        return response([
            'message' => 'A Post is updated successfully',
            'data' => $post,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (File::exists(storage_path('app/public/images/') . $post->image)) {
            File::delete(storage_path('app/public/images/') . $post->image);
        }
        $post->categories()->sync([]);
        $post->delete();

        return response([
            'message' => 'A Post deleted successfully!',
        ]);
    }

    /**
     * Summary of relatedPosts
     * @param mixed $post_id
     * @return mixed
     */
    public function relatedPosts($category_id)
    {
        $categories = Category::find($category_id)->get();

        $posts = Post::with('categories')
            ->filter(request('search'))
            ->latest('created_at')
            ->paginate(10);

        return response()->json([
            'posts' => $posts,
            'categories' => $categories,
        ]);
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