<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
	public function getSearch(Request $request)
	{
		$this->validate($request, [
			'query' => 'required'
		]);
		$query = $request['query'];

		$posts = Post::orderBy('created_at', 'desc')->where('title', 'like', $query)->get();
		return view('includes.search-index', ['posts' => $posts]);		
	}
}