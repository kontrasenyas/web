<?php
namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\Like;
use App\PostPhoto;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;

class PostController extends Controller
{
	public function getUserPost($user_id)
	{
		$posts = Post::orderBy('created_at', 'desc')->where('user_id', $user_id)->paginate(5);
		$post = Post::where('user_id', $user_id)->first();
		if ($post != NULL) {
			$user = $post->user()->where('id', $user_id)->first();
		}
		else {
			$user = User::Find($user_id);
		}
		return view('posts.user-post', ['posts' => $posts, 'user' => $user]);
	}
	
	public function postCreatePost(Request $request)
	{
		//Validation

		$this->validate($request, [			
			'title' => 'required|max:100',
			'capacity' => 'required|numeric|max:100',
			'image' => 'image',
			'contact_no' => 'required|regex:/(09)[0-9]{9}/',
			'location' => 'required|max:100',
			'body' => 'required|max:1000',
			'radio_type' => 'required'
			], ['image.image' => 'Photo must be a valid image file.']

			);

		$post = new Post();
		$post->title = $request['title'];
		$post->capacity = $request['capacity'];
		$post->body = $request['body'];
		$post->contact_no = $request['contact_no'];
		$post->location = $request['location'];
		$post->type = $request['radio_type'];
		$message = 'There was an error';


		// $file = $request->file('image');
		// $filename = uniqid() . '.jpg';

		// $image_resize = Image::make($file->getRealPath());
  		// $image_resize->resize(920, 1000);

		// if ($file) {
		// 	Storage::disk('local')->put('post-photos/' . $filename, $image_resize->stream()->__toString());

		// 	$post->image_name = $filename;
		// }

		if ($request->user()->posts()->save($post)) {
			$message = 'Post succesfully created!';
		}

		if ($request->images[0]) {
			$count = 0;

			foreach ($request->images as $image) {
				$filename = uniqid() . '.jpg';
				$image_resize = Image::make($image->getRealPath());
	    		$image_resize->resize(920, 1000);

	    		Storage::disk('local')->put('post-photos/' . $filename, $image_resize->stream()->__toString());
	    		PostPhoto::create([
	                'post_id' => $post->id,
	                'filename' => $filename
	            ]);

	    		if ($count == 0) {
	    			$post->image_name = $filename;
	    		}
	    		$count++;
			}
		}

		$post->update();

		return redirect()->route('dashboard')->with(['message' => $message]);
	}

	public function getDeletePost($post_id)
	{
		$post = Post::where('id', $post_id)->first();
		$post_photos = PostPhoto::where('post_id', $post_id);
		
		if (Auth::user() != $post->user) {
			return redirect()->back();
		}
		$post_photos->delete();
		$post->delete();

		return redirect()->route('dashboard')->with(['message' => 'Succesfully deleted']); 
	}

	public function postEditPost(Request $request) {
		$this->validate($request, [
			'body' => 'required',
			'capacity' => 'required|numeric|max:100',
			'contactNo' => 'required|regex:/(09)[0-9]{9}/',
			'location' => 'required'
			]);

		$post = Post::find($request['postId']);

		if (Auth::user() != $post->user) {
			return redirect()->back();
		}

		$post->body = $request['body'];
		$post->capacity = $request['capacity'];
		$post->contact_no = $request['contactNo'];
		$post->location = $request['location'];
		$post->update();
		return response()->json(['message' => 'Post edited', 'new_body' => $post->body, 'new_capacity' => $post->capacity, 'new_contact' => $post->contact_no, 'new_location' => $post->location], 200);
	}

	public function postLikePost(Request $request)
	{
		$post_id = $request['postId'];
		$is_like = $request['isLike'] === 'true' ? true : false;
		$update = false;
		$post = Post::find($post_id);
		if (!$post) {
			return null; //Error message JSON
		}

		$user = Auth::user();
		$like = $user->likes()->where('post_id', $post_id)->first();

		if ($like) {
			$already_like = $like->like;
			$update = true;
			if ($already_like == $is_like) {
				$like->delete();
				return null;
			}
		}
		else {
			$like = new Like();
		}

		$like->like = $is_like;
		$like->user_id = $user->id;
		$like->post_id = $post->id;

		if ($update) {
			$like->update();
		}
		else {
			$like->save();
		}
		return null;
	}

	public function getPostDetails($post_id)
	{
        $post = Post::where('id', $post_id)->first();
        $post_photos = PostPhoto::where('post_id', $post->id)->get();

        $user_id = $post->user->id;
        $reviews = Review::where('user_to', $user_id)->orderBy('created_at', 'desc')->get();
		$reviews_total = Review::where('user_to', $user_id)->sum('rating');
        $rating = round($reviews_total / Review::where('user_to', $user_id)->get()->count(), 2);

        if (is_null($post)) {
        	abort(404);
        }
        Post::where('id', $post_id)->increment('view_count');
		return view('posts.details', ['post' => $post, 'post_photos' => $post_photos, 'rating' => $rating, 'reviews' => $reviews]);
	}

	public function getPostImage($filename)
	{
		$file = Storage::disk('local')->get('post-photos/' . $filename);
		return new Response($file, 200);
	}

	public function deletePostImage($filename)
	{
		// Delete photo
		$post_photo = PostPhoto::where('filename', $filename)->first();

		if (Auth::user() != $post_photo->post()->first()->user) {
			return redirect()->back();
		}

		$post_photo->delete();
		Storage::disk('local')->delete('post-photos/'. $filename);

		// Update default post photo
		$change_photo = PostPhoto::where('post_id', $post_photo->post_id)->first();
		$post = Post::where('id', $post_photo->post_id)->first();

		if($change_photo)
		{			
			$post->image_name = $change_photo->filename;		
		}
		else 
		{
			$post->image_name = 'default.jpg';
		}

		$post->update();

		return redirect()->back()->with(['message' => 'Succesfully deleted']); 
	}

	public function postUpdateImage(Request $request)
	{
		$this->validate($request, [
			'image' => 'image'
			], ['image.image' => 'Photo must be a valid image file.'
		]);
		$post_id = $request['post_id'];
		// $file = $request->file('image');
		// $filename = uniqid() . '.jpg';

		// $image_resize = Image::make($file->getRealPath());              
  //   	$image_resize->resize(920, 1000);

		$post = Post::find($post_id);

		// if ($file) {
		// 	Storage::disk('local')->put('post-photos/' . $filename, $image_resize->stream()->__toString());

		// 	$post->image_name = $filename;
		// }

		// $post->update();
		$message = 'Photo succesfully changed!';

		$count = 0;

		foreach ($request->images as $image) {
			$filename = uniqid() . '.jpg';
			$image_resize = Image::make($image->getRealPath());
    		$image_resize->resize(920, 1000);

    		Storage::disk('local')->put('post-photos/' . $filename, $image_resize->stream()->__toString());
    		PostPhoto::create([
                'post_id' => $post->id,
                'filename' => $filename
            ]);

    		if ($count == 0) {
    			$post->image_name = $filename;
    			$post->update();
    		}
    		$count++;
		}

		return redirect()->back()->with(['message' => $message]);
	}
}
