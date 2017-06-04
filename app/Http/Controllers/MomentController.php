<?php

namespace App\Http\Controllers;

use App\Moment;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class MomentController extends Controller
{
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

        return redirect()->route('moments.user', ['user_id' => Auth::user()->id])->with(['message' => $message]);
    }

    public function getMoments($user_id)
    {
        $moments = Moment::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();
        $moment = Moment::where('user_id', $user_id)->first();
        if ($moment != NULL) {
            $user = $moment->user()->where('id', $user_id)->first();
        }
        else {
            $user = User::Find($user_id);
        }

        return view('moments.index', ['moments' => $moments, 'user' => $user]);
    }

    public function getMomentImage($filename)
    {
        $file = Storage::disk('local')->get('moments-photos/' . $filename);
        return new Response($file, 200);
    }
}
