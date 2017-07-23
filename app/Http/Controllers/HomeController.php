<?php
namespace App\Http\Controllers;

use App\Post;
use App\Review;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
	public function getHome()
	{
		$posts = Post::orderBy('created_at', 'desc')->paginate(2);
		return view('home', ['posts' => $posts]);
	}
    public function getDashboard()
    {
        $user_id = Auth::user()->id;
        $posts = Post::orderBy('created_at', 'desc')->where('user_id', $user_id)->paginate(3);
        $reviews = Review::where('user_to', $user_id)->orderBy('created_at', 'desc')->paginate(6);

        return view('posts.dashboard', ['posts' => $posts, 'reviews' => $reviews]);
    }

	public function getAbout()
    {
        return view('about');
    }
    public function getContact()
    {
        return view('contact');
    }
    public function getHelp()
    {
        return view('help');
    }
    public function getTerms()
    {
        return view('terms');
    }
}