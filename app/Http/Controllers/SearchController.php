<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Location;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
	public function index()
	{
		return view('includes.search');
	}
	public function getSearch(Request $request)
	{
		$this->validate($request, [
			'query' => 'required_without_all:keywords,location',
			], ['query.required_without_all' => 'Please fill atleast one field.']

		);

		$query =  $request['query'];
		$location = $request['location'];
		$keywords = $request['keywords'];

		if (isset($location) && isset($query) && $keywords) {
			$posts = Post::orderBy('created_at', 'desc')->where('title', 'like', '%' . $query . '%')->where('location', 'like', $location)->where('body', 'like', $keywords)->paginate(5);
		}
		else if (isset($location) && isset($query)) {
			$posts = Post::orderBy('created_at', 'desc')->where('title', 'like', $query)->where('location', 'like', $location)->paginate(5);
		}
		else if (isset($location) && isset($keywords)) {
			$posts = Post::orderBy('created_at', 'desc')->where('body', 'like', $keywords)->where('location', 'like', $location)->paginate(5);
		}
		else if (isset($keywords) && isset($query)) {
			$posts = Post::orderBy('created_at', 'desc')->where('body', 'like', '%' . $keywords . '%')->where('location', 'like', '%' . $location . '%')->paginate(5);
		}
		else if (isset($query)) {
			$posts = Post::orderBy('created_at', 'desc')->where('title', 'like', '%' . $query . '%')->paginate(5);
		}
		else if (isset($location)) {
			$posts = Post::orderBy('created_at', 'desc')->where('location', 'like', '%' . $location . '%')->paginate(5);
		}
		else if (isset($keywords)) {
			$posts = Post::orderBy('created_at', 'desc')->where('body', 'like', '%' . $keywords . '%')->paginate(5);
		}
		else {
			$query = '';
			$location = '';
			$posts = Post::orderBy('created_at', 'desc')->where('location', 'like', $location)->paginate(5);
		}
		
		return view('includes.search-index', ['posts' => $posts]);		
	}

	public function getSearchLocation(Request $request)
	{
		$data = Location::select("city as name")->where("city","LIKE","%{$request->input('query')}%")->get();

		return response()->json($data);
	}
}