<?php

namespace App\Http\Controllers;

use App\Moment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class MomentController extends Controller
{
    public function getIndex()
    {
        return view('moments.index');
    }

    public function postMoment(Request $request)
    {
        $this->validate($request, [
           'body' => 'required',
            'image' => 'required',
            'location' => 'required'
        ]);

        $moment = new Moment();

        $moment->body = $request['body'];
        $moment->location = $request['location'];
        $moment->user_id = Auth::user()->id;

        $file = $request->file('image');
        $filename = uniqid() . '.jpg';

        if ($file) {
            Storage::disk('local')->put('moments-photos/' . $filename, File::get($file));

            $moment->image = $filename;
        }

        if ($request->user()->moments()->save($moment)) {
            $message = 'Moments succesfully created!';
        }

        return redirect()->route('moments')->with(['message' => $message]);


    }
}
