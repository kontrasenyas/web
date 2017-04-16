<?php
namespace App\Http\Controllers;

use App\Post;
use App\Like;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
	public function getDashboard()
	{
		$posts = Post::orderBy('created_at', 'desc')->where('user_id', Auth::user()->id)->paginate(5);
		return view('posts.dashboard', ['posts' => $posts]);
	}

	public function getUserPost($user_id)
    {
        $posts = Post::orderBy('created_at', 'desc')->where('user_id', $user_id)->paginate(5);
        return view('posts.user-post', ['posts' => $posts, 'user_id' => $user_id]);
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
			'body' => 'required|max:1000'
		], ['image.image' => 'Photo must be a valid image file.']

		);

		$post = new Post();
		$post->title = $request['title'];
		$post->capacity = $request['capacity'];
		$post->body = $request['body'];
		$post->contact_no = $request['contact_no'];
		$post->location = $request['location'];
		$message = 'There was an error';

		$file = $request->file('image');
		$filename = uniqid() . '.jpg';

		if ($file) {
			Storage::disk('local')->put('post-photos/' . $filename, File::get($file));

			$post->image_name = $filename;
		}

		if ($request->user()->posts()->save($post)) {
			$message = 'Post succesfully created!';
		}

		return redirect()->route('dashboard')->with(['message' => $message]);
	}

	public function getDeletePost($post_id)
	{
		$post = Post::where('id', $post_id)->first();
		
		if (Auth::user() != $post->user) {
			return redirect()->back();
		}

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
		return view('posts.details', ['post' => $post]);
	}

	public function getPostImage($filename)
	{
		$file = Storage::disk('local')->get('post-photos/' . $filename);
		return new Response($file, 200);
	}
	public function postUpdateImage(Request $request)
	{
		$post_id = $request['post_id'];
		$file = $request->file('image');
		$filename = uniqid() . '.jpg';

		$post = Post::find($post_id);

		if ($file) {
			Storage::disk('local')->put('post-photos/' . $filename, File::get($file));

			$post->image_name = $filename;
		}

		$post->update();
		$message = 'Photo succesfully changed!';

		return redirect()->back()->with(['message' => $message]);
	}
}
