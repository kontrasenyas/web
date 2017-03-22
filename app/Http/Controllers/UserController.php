<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
	public function postSignUp(Request $request)
	{
		$this->validate($request, [
			'mobile_no' => 'required|unique:users|numeric',
			'password' => 'required|min:4',
			'first_name' => 'required|max:120',
			'last_name' => 'required|max:120',

		]);

		$mobile_no = $request['mobile_no'];
		$password = bcrypt($request['password']);
		$first_name = $request['first_name'];
		$last_name = $request['last_name'];

		$user = new User();
		$user->mobile_no = $mobile_no;
		$user->password = $password;
		$user->first_name = $first_name;
		$user->last_name = $last_name;

		$user->save();

		Auth::login($user);

		return redirect()->route('dashboard');
	}

	public function postSignIn(Request $request)
	{
		$this->validate($request, [
			'mobile_no' => 'required',
			'password' => 'required'
		]);
		
		if(Auth::attempt(['mobile_no' => $request['mobile_no'], 'password' => $request['password']])) {
			return redirect()->route('dashboard');
		}
		else {
			return back()->withErrors([
            'message' => 'Username/Password is invalid!'
        ]);
		}
	}

	public function getLogout()
	{
		Auth::logout();
		return redirect()->back();
	}

	public function getAccountIndex()
	{
		return view('accounts.index', ['user' => Auth::user()]);
	}

	public function getAccountProfile($user_id)
	{
		$user = User::where('id', $user_id)->first();		
		return view('accounts.profile', ['user' => $user]);
	}

	public function postSaveAccount(Request $request)
	{
		$user = Auth::user();

		$this->validate($request, [
			'first_name' => 'required|max:120',
			'last_name' => 'required|max:120',
			'mobile_no' => 'required|numeric|unique:users,mobile_no,'. Auth::id()
		]);
		
		$user->first_name = $request['first_name'];
		$user->last_name = $request['last_name'];
		$user->mobile_no = $request['mobile_no'];
		

		$file = $request->file('image');
		$filename = $user->id . '-' . $user->first_name . '-' . $user->last_name . '.jpg';

		if ($file) {
			Storage::disk('local')->put('profile_picture/' . $filename, File::get($file));
			$user->profile_picture_path = $filename;
		}

		$user->update();
		return redirect()->route('account')->with(['message' => 'Account successfully updated!']);
	}

	public function getUserImage($filename)
	{
		$file = Storage::disk('local')->get('profile_picture/' . $filename);
		return new Response($file, 200);
	}
}