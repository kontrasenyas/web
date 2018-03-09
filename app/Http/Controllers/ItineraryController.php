<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Itinerary;

class ItineraryController extends Controller
{
    public function getCreateItinerary()
	{
		return view('posts.create-itinerary');
	}

	public function postCreateItinerary(Request $request)
	{
		$this->validate($request, [			
			'title' => 'required|max:100',
			'body' => 'required',
			'location' => 'required'
		]);

		$itinerary = new Itinerary();
		
		$itinerary->title = $request['title'];
		$itinerary->body = $request['body'];
		$itinerary->location = $request['location'];
		$message = 'There was an error';

		if ($request->user()->itinerary()->save($itinerary)) {
			$message = 'Itinerary succesfully created!';
		}

		$itinerary->update();

		return redirect()->route('create-itinerary')->with(['message' => $message]);
	}

	public function getItineraryIndex($user_id)
	{
		$itinerary = Itinerary::where('user_id', $user_id)->get();
		$user = User::where('id', $user_id)->first();

		return view('posts.index-itinerary', ['itinerary_list' => $itinerary, 'user' => $user]);
	}

	public function getItinerary($itinerary_id)
	{
		$itinerary = Itinerary::where('id', $itinerary_id)->first();

		return view('posts.detail-itinerary', ['itinerary' => $itinerary]);
	}
}
