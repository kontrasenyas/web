<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Location;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
	public function getHome()
	{
		$posts = Post::orderBy('created_at', 'desc')->paginate(5);
		return view('home', ['posts' => $posts]);
	}
}