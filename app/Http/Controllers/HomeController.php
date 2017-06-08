<?php
namespace App\Http\Controllers;

use App\Post;

class HomeController extends Controller
{
	public function getHome()
	{
		$posts = Post::orderBy('created_at', 'desc')->paginate(6);
		return view('home', ['posts' => $posts]);
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