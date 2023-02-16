<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordChangeRequest;
use App\Http\Requests\ProfileEditRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     *
     * @return \Illuminate\Http\Response
     */
    public function showProfile()
    {
        $user = User::findOrFail($user_id = auth()->id());
        $posts = Post::filter(request('search'))->whereBelongsTo($user)->paginate(10);

        return response()->json([
            'user' => $user,
            'posts' => $posts,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileEditRequest $request, $id)
    {
        $user = User::find($id);

        if ($request->file('image')) {

            $userImage = time() . '.' . $request->file('image')->extension();
            $request->image->move(storage_path('app/public/images'), $userImage);
            $user->image = $userImage;
        }
        $user->name = $request->name;
        $user->bio = $request->bio;
        $user->save();

        $posts = Post::where('user_id', $id)
            ->paginate(10);

        return response([
            'message' => 'User Info changed successfully!',
            'data' => $posts,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response([
            'message' => 'User Deleted Successfully!',
        ]);
    }

    public function updatePassword(PasswordChangeRequest $request, $id)
    {
        #Match The Old Password
        if (!Hash::check($request->old_password, auth()->user()->password)) {

            return back()->with("warning", "Old Password Doesn't match!");
        }

        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        $posts = Post::where('user_id', $id)
            ->paginate(10);

        return response([
            'message' => 'Password changed successfully!',
            'data' => $posts,
        ]);
    }
}