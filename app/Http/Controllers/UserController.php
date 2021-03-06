<?php
namespace App\Http\Controllers;

use App\User;
use App\Review;
use App\ForgotPassword;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Socialite;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Redirect;
use Session;

\Tinify\setKey(env('TINYPNG_KEY'));

class UserController extends Controller
{
	/**
     * Redirect the user to the Facebook authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $userSocial = Socialite::driver('facebook')->user();

        $findUser = User::where('email', $userSocial->email)->first();
		$redirect = session('url.intended');

		if ($findUser) {   
	        Auth::login($findUser);
    	}
    	else {
    		$name = explode(' ', $userSocial->name);

	        // Remove middle initial
			foreach($name as $key => $one) {
			    if(strpos($one, '.') !== false)
			        unset($name[$key]);
			}

	        $last_name = array_pop($name);
	        $first_name = implode(' ', $name);

	        $user = new User();

	        $user->email = $userSocial->email;
	        $user->mobile_no = '00000000000';
	        $user->password = bcrypt(uniqid());
	        $user->first_name = $first_name;
	        $user->last_name = $last_name;

	        $file = file_get_contents($userSocial->getAvatar());
			$filename = $user->id . '-' . $user->first_name . '-' . $user->last_name . '.jpg';
			
			Storage::disk('local')->put('profile_picture/' . $filename, $file);
			$user->profile_picture_path = $filename;

	        $user->save();
	        Auth::login($user);
    	}        

        return redirect($redirect);
	}

	public function getEmail($email)
	{
		$user = User::where('email', $email)->select('email')->first();

		if (!$user) {
			return 1;
		}

		else {
			return 0;
		}		
	}
	public function getMobileNo($mobileno)
	{
		$user = User::where('mobile_no', $mobileno)->select('mobile_no')->first();

		if (!$user) {
			return 1;
		}

		else {
			return 0;
		}		
	}

	public function postSignUp(Request $request)
	{
        $this->validate($request, [
			'email' => 'required|email|unique:users',
			'mobile_no' => 'required|unique:users|regex:/(09)[0-9]{9}/',
			'password' => 'required|min:8',
			'first_name' => 'required|max:120',
			'last_name' => 'required|max:120',

		]);

		$redirect = session('url.intended');

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

        if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
            $secret = '6LfOYSAUAAAAAORzpDvtLOY621CyzACD239nURPV';
            //get verify response data
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
            $responseData = json_decode($verifyResponse);
            if ($responseData->success) {
                $user->save();
                Mail::to($email)
				->send(new \App\Mail\SendEmailRegisteredUser($user->first_name, $user->last_name, $user->mobile_no));
                Auth::login($user);
                return redirect($redirect);
            }
        }
        else {
            return back()->withErrors([
                'message' => 'Invalid captcha.'
            ]);
        }
	}

	public function getLoginPage()
	{
		if (Auth::check()) {
			return Redirect::to('/');
		}

	    if(!session()->has('url.intended'))
	    {
	        session(['url.intended' => url()->previous()]);
	    }

		return view('accounts.login');
	}

	public function clearSessionKey($key)
    {
        if (Session::has($key))
        {
            Session::forget($key);
        }
    }

	public function getSignUpPage()
	{
		if (Auth::check()) {return Redirect::to('/');}

	    if(!session()->has('url.intended'))
	    {
	        session(['url.intended' => url()->previous()]);
	    }

		return view('accounts.register');
	}

	public function postSignIn(Request $request)
	{
		$redirect = session('url.intended');

		$this->validate($request, [
			'mobile_no' => 'required',
			'password' => 'required'
		]);
		
		if(Auth::attempt(['mobile_no' => $request['mobile_no'], 'password' => $request['password']])) {
			return redirect($redirect);
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
		$this->clearSessionKey('url.intended');
		return redirect()->route('home');
	}

	public function getAccountEdit()
	{
		return view('accounts.index', ['user' => Auth::user()]);
	}

	public function getAccountProfile($user_id)
	{
		$user = User::where('id', $user_id)->first();
		
		if (is_null($user)) {
			abort(404);
		}
		$posts = $user->posts()->where('user_id', $user->id)->get();
        $reviews = Review::where('user_to', $user_id);

        if($reviews->count() > 0)
        {
        	$reviews = $reviews->orderBy('created_at', 'desc')->paginate(3);
            $reviews_total = Review::where('user_to', $user_id)->sum('rating');
            $rating = round($reviews_total / Review::where('user_to', $user_id)->get()->count(), 2);

            return view('accounts.profile', ['user' => $user, 'posts' => $posts, 'reviews' => $reviews, 'rating' => $rating]);
        }
        else
        {
        	$reviews = $reviews->get();
            return view('accounts.profile', ['user' => $user, 'posts' => $posts, 'reviews' => $reviews]);
        }		
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

		$image = $request->file('image');
		$filename = $user->id . '-' . $user->first_name . '-' . $user->last_name . '.jpg';

		if ($image) {
			$filename_optimize = "images/". "optimize-" . $filename;
			$image_resize = Image::make($image->getRealPath());
    		$image_resize->resize(135, 135);
    		$image_resize->save('images/' . $filename);
    		$source = \Tinify\fromFile('images/' . $filename);
			$source->toFile($filename_optimize);

			$image_resize = Image::make($filename_optimize);
			Storage::disk('local')->put('profile_picture/' . $filename, $image_resize->stream()->__toString());
    		unlink($filename_optimize);
    		unlink('images/' . $filename);

			$user->profile_picture_path = $filename;
		}

		$user->update();
		return redirect()->back()->with(['message' => 'Account successfully updated.']);
	}

	public function postSaveMobile(Request $request)
	{
		$user = Auth::user();

		$this->validate($request, [
			'mobile_no' => 'required|regex:/(09)[0-9]{9}/|unique:users,mobile_no,'. Auth::id()
		]);

		$user->mobile_no = $request['mobile_no'];

		$user->update();
		return redirect()->back()->with(['message' => 'Account successfully updated.']);
	}

	public function getUserImage($filename)
	{
		$file = Storage::disk('local')->get('profile_picture/' . $filename);
		return new Response($file, 200);
	}

	public function postUserImage(Request $request)
	{
		$user = Auth::user();
		$this->validate($request, [
			'image' => 'required',
		]);
		$image = $request->file('image');
		$filename = $user->id . '-' . $user->first_name . '-' . $user->last_name . '.jpg';

		if ($image) {
			$filename_optimize = "images/". "optimize-" . $filename;
			$image_resize = Image::make($image->getRealPath());
    		$image_resize->resize(135, 135);
    		$image_resize->save('images/' . $filename);
    		$source = \Tinify\fromFile('images/' . $filename);
			$source->toFile($filename_optimize);

			$image_resize = Image::make($filename_optimize);
			Storage::disk('local')->put('profile_picture/' . $filename, $image_resize->stream()->__toString());
    		unlink($filename_optimize);
    		unlink('images/' . $filename);

			$user->profile_picture_path = $filename;
		}

		$user->update();
		return redirect()->back()->with(['message' => 'Profile picture successfully updated.']);
	}

	public function getReview($user_id)
	{
		$user = User::Find($user_id);
		$reviews = Review::where('user_to', $user_id)->orderBy('created_at', 'desc')->paginate(6);

		if($reviews->count() > 0)
        {
            $reviews_total = Review::where('user_to', $user_id)->sum('rating');
            $rating = round($reviews_total / Review::where('user_to', $user_id)->get()->count(), 2);

            return view('accounts.review', ['user' => $user, 'reviews' => $reviews, 'rating' => $rating]);
        }
        else
        {
            return view('accounts.review', ['user' => $user, 'reviews' => $reviews]);
        }
	}
	public function postReview(Request $request)
	{
	    $this->validate($request, [
	       'comment' => 'required',
            'rating' => 'required'
        ],
            [
                'rating.required' => 'Please rate the user from 0 to 5.'
            ]);
		$user_id = $request['user_id'];
		$comment = $request['comment'];
		$rating = $request['rating'];

		$review = new Review();

        $review->user_to = $user_id;
        $review->user_id = Auth::user()->id;
        $review->comment = $comment;
        $review->rating = $rating;

        $review->save();
		return redirect()->route('account.profile', ['id' => $user_id])->with(['message' => 'Thank you for your feedback.']);
	}
	public function getDeleteReview($review_id)
	{
		$review = Review::where('id', $review_id)->first();
		
		if (Auth::user() != $review->user) {
			return redirect()->back();
		}
		$review->delete();

		return redirect()->back()->with(['message' => 'Review succesfully deleted']); 
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

	public function getForgotPasswordSMS()
    {
        return view('accounts.forgot-password-sms');
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
            $token = bin2hex(openssl_random_pseudo_bytes(24));
			$valid_until = date("Y-m-d H:i:s", time() + 86400);

			$forgot_password = new ForgotPassword();

			$forgot_password->user_id = $user_id;
			$forgot_password->mobile_no = $mobile_no;
			$forgot_password->code = $code;
			$forgot_password->token = $token;
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

			//$fg = ForgotPassword::where('mobile_no', $mobile_no)->orderBy('valid_until', 'desc')->first();
			//return $fg;

			$context  = stream_context_create($param);
			$return = file_get_contents($url, false, $context);

            return redirect()->back()->with(['message' => 'Please check your mobile for instructions.']);
		}
		else {
			return back()->withErrors([
			    'message' => 'Mobile Number is Invalid.'
			]);
		}
	}	
}