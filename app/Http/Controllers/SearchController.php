<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Location;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
	public function getSearch(Request $request)
	{
		$this->validate($request, [
			'query' => 'required_without_all:location'
			], ['query.required_without_all' => 'Please fill atleast one field.']

		);

		$query = $request['query'];
		$location = $request['location'];

		if (isset($location) && isset($query)) {
			$posts = Post::orderBy('created_at', 'desc')->where('title', 'like', $query)->where('location', 'like', $location)->get();
		}
		else if (isset($query)) {
			$posts = Post::orderBy('created_at', 'desc')->where('title', 'like', $query)->get();
		}
		else if (isset($location)) {
			$posts = Post::orderBy('created_at', 'desc')->where('location', 'like', $location)->get();
		}
		else {
			$query = '';
			$location = '';
			$posts = Post::orderBy('created_at', 'desc')->where('location', 'like', $location)->get();
		}
		
		return view('includes.search-index', ['posts' => $posts]);		
	}

	public function getSearchLocation(Request $request)
	{
		$data = Location::select("city as name")->where("city","LIKE","%{$request->input('query')}%")->get();

		return response()->json($data);
	}
}