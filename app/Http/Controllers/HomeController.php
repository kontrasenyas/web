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
}