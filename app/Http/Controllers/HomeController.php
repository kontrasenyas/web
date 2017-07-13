<?php
namespace App\Http\Controllers;

use App\Post;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
	public function getHome()
	{
		$posts = Post::orderBy('created_at', 'desc')->paginate(6);
		return view('home', ['posts' => $posts]);
	}
    public function getDashboard()
    {
        $posts = Post::orderBy('created_at', 'desc')->where('user_id', Auth::user()->id)->paginate(3);
        return view('posts.dashboard', ['posts' => $posts]);
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