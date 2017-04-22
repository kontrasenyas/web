<?php
namespace App\Http\Controllers;

use App\User;
use App\ForgotPassword;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
	public function postSignUp(Request $request)
	{
		$this->validate($request, [
			'email' => 'required|email|unique:users',
			'mobile_no' => 'required|unique:users|regex:/(09)[0-9]{9}/',
			'password' => 'required|min:8',
			'first_name' => 'required|max:120',
			'last_name' => 'required|max:120',

		]);

		$email = $request['email'];
		$mobile_no = $request['mobile_no'];
		$password = bcrypt($request['password']);
		$first_name = ucwords($request['first_name']);
		$last_name = ucwords($request['last_name']);

		$user = new User();
		$user->email = $email;
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
            'message' => 'Username/Password is Invalid.'
        ]);
		}
	}

	public function getLogout()
	{
		Auth::logout();
		return redirect()->back();
	}

	public function getAccountEdit()
	{
		return view('accounts.index', ['user' => Auth::user()]);
	}

	public function getAccountProfile($user_id)
	{
		$user = User::where('id', $user_id)->first();
		$posts = $user->posts()->where('user_id', $user->id)->get();
		return view('accounts.profile', ['user' => $user, 'posts' => $posts]);
	}

	// public function getEditAccountIndex()
	// {
	// 	$user = Auth::user();
	// 	return view('accounts.index', ['user' => $user]);
	// }

	public function postSaveAccount(Request $request)
	{
		$user = Auth::user();

		$this->validate($request, [
			'first_name' => 'required|max:120',
			'last_name' => 'required|max:120',
			'mobile_no' => 'required|regex:/(09)[0-9]{9}/|unique:users,mobile_no,'. Auth::id(),
			'email' => 'required|email|unique:users,email,'. Auth::id()
		]);
		
		$user->first_name = ucwords($request['first_name']);
		$user->last_name = ucwords($request['last_name']);
		$user->mobile_no = $request['mobile_no'];
		$user->email = $request['email'];
		

		$file = $request->file('image');
		$filename = $user->id . '-' . $user->first_name . '-' . $user->last_name . '.jpg';

		if ($file) {
			Storage::disk('local')->put('profile_picture/' . $filename, File::get($file));
			$user->profile_picture_path = $filename;
		}

		$user->update();
		return redirect()->route('account.edit')->with(['message' => 'Account successfully updated.']);
	}

	public function getUserImage($filename)
	{
		$file = Storage::disk('local')->get('profile_picture/' . $filename);
		return new Response($file, 200);
	}

	public function getFeedback($user_id)
	{
		$user = User::Find($user_id);
		return view('accounts.feedback', ['user' => $user]);
	}

	public function getChangePassword()
	{
		return view('accounts.change-password', ['user' => Auth::user()]);
	}

	public function postChangePassword(Request $request)
	{	

		$this->validate($request, [
			'current-password' => 'required',
			'password' => 'required|min:8|same:password',
			'confirm-password' => 'same:password',
		], 
		[
			'current-password.required' => 'Please enter your Current Password.',
			'password.required' => 'Please enter your New Password.',
			'confirm-password.same' => 'Confirm Password does not match.',
		]
		);

		$current_password = Auth::user()->password;

		if (Hash::check($request['current-password'], $current_password)) {
			$user_id = Auth::User()->id;
			$user = User::Find($user_id);
			$user->password = Hash::make($request['password']);
			$user->save();

			return redirect()->route('account.get-change-password')->with(['message' => 'Password successfully updated.']);
		}
		else {
			return back()->withErrors([
            	'message' => 'Current Password is Invalid.'
        	]);
		}
	}

	public function getForgotPassword()
	{
		return view('accounts.forgot-password');
	}

	public function getResetPassword($token, $code)
	{
		$fg = ForgotPassword::where('token', $token)->where('code', $code)->first();
		$fg_latest = ForgotPassword::where('user_id', $fg->user_id)->orderBy('created_at', 'desc')->first();

		if (($fg->token == $fg_latest->token) && $fg->verified == 0) {
			if ($fg != null) {
			return view('accounts.reset-password')->with(['token' => $token, 'code' => $code]);
			}
			else if ($fg->verified == 1){
				return redirect()->route('reset-password-error');
			}	
		}
		else {
			return redirect()->route('reset-password-error');
		}			
	}

	public function postResetPassword(Request $request)
	{
		$token = $request['password_token'];
		$code = $request['code'];
		$fg = ForgotPassword::where('token', $token)->where('code', $code)->first();

		$this->validate($request, [
			'password' => 'required|min:8'
		]);

		if ($fg->verified == 0) {
			$user_id = $fg->user_id;
			$user = User::Find($user_id);
			$user->password = Hash::make($request['password']);
			$user->save();

			$fg->verified = 1;
			$fg->save();

			return view('accounts.reset-password-success');
		}
		else {
			return redirect()->route('reset-password-error');
		}
		
	}

	public function postSendEmailForgotPassword(Request $request)
	{
		$email = $request['email'];
		$user = User::where('email', $email)->first();

		if ($user != null) {
			$user_id = $user->id;
			$code = strtoupper(str_random(5));
			$token = bin2hex(openssl_random_pseudo_bytes(24));
			$valid_until = date("Y-m-d H:i:s", time() + 86400);			

			$forgot_password = new ForgotPassword();

			$forgot_password->user_id = $user_id;
			$forgot_password->email = $email;
			$forgot_password->code = $code;
			$forgot_password->token = $token;
			$forgot_password->valid_until = $valid_until;
			$forgot_password->save();

			Mail::to($email)
				->send(new \App\Mail\SendEmailForgotPassword($user->first_name, $user->last_name, $code, $token));
			return redirect()->back()->with(['message' => 'Please check your email for instructions.']);
		}
		else {
			return back()->withErrors([
			    'message' => 'Email Address is Invalid.'
			]);
		}
	}

	public function postSendSMS(Request $request)
	{
		$this->validate($request, [
			'mobile_no' => 'required'
		]);

		$mobile_no = $request['mobile_no'];
		$user = User::where('mobile_no', $mobile_no)->first();		

		if ($user != null) {
			$user_id = $user->id;
			$code = strtoupper(str_random(5));
			$valid_until = date("Y-m-d H:i:s", time() + 86400);

			$forgot_password = new ForgotPassword();

			$forgot_password->user_id = $user_id;
			$forgot_password->mobile_no = $mobile_no;
			$forgot_password->code = $code;
			$forgot_password->valid_until = $valid_until;
			$forgot_password->save();

			$message = 'Your verification code: ' . $code;
			$apicode = 'TR-JOSEP290793_EH77D';

			$url = 'https://www.itexmo.com/php_api/api.php';
			$itexmo = array('1' => $mobile_no, '2' => $message, '3' => $apicode);
			$param = array(
			    'http' => array(
			        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			        'method'  => 'POST',
			        'content' => http_build_query($itexmo),
			    ),
			);

			$fg = ForgotPassword::where('mobile_no', $mobile_no)->orderBy('valid_until', 'desc')->first();
			return $fg;

			//$context  = stream_context_create($param);
			//$return = file_get_contents($url, false, $context);
		}
		else {
			return back()->withErrors([
			    'message' => 'Mobile Number is Invalid.'
			]);
		}
	}	
}