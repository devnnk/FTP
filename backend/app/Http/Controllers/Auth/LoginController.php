<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Socialite;
use Validator,Redirect,Response,File;
use App\Model\User;
use Illuminate\Support\Str;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        // dd($credentials);
        if (Auth::attempt($credentials)) {
            if (Auth::user()->role=='admin') {
                echo "admin";
            }else if (Auth::user()->role=='normal') {
                echo "normal";
            }
        }else{
            return redirect('/login')->with('key','Sai tên đăng nhập hoặc mật khẩu.');
        }
    }
    //social
    public function redirect($provider)
     {
        $facebookScope = [
            'email',
            'user_videos',
            'user_posts',
            'publish_video',
            'groups_access_member_info',
            'pages_manage_instant_articles',
            'pages_show_list',
            'publish_to_groups',
            'read_page_mailboxes',
            'pages_messaging'
        ];
        return Socialite::driver($provider)->usingGraphVersion('v7.0')->scopes($facebookScope)->redirect();;

     }
     public function callback($provider)
     {
        $facebookScope = [
            'email',
            'user_videos',
            'user_posts',
            'publish_video',
            'groups_access_member_info',
            'pages_manage_instant_articles',
            'pages_show_list',
            'publish_to_groups',
            'read_page_mailboxes',
            'pages_messaging'
        ];
       $getInfo = Socialite::driver($provider)->usingGraphVersion('v7.0')->scopes($facebookScope)->user();
       // dd($getInfo);
       $user = $this->createUser($getInfo,$provider); 
       auth()->login($user);
       // dd($user = Auth::user());
       return redirect()->to('/home');
     }
     function createUser($getInfo,$provider){
     $user = User::where('provider_id', $getInfo->id)->first();
     if (!$user) {
          $user = User::create([
             'name'     => $getInfo->name,
             'email'    => $getInfo->email,
             'provider' => $provider,
             'provider_id' => $getInfo->id,
             'access_token'=> $getInfo->token,
             // 'tokens'   =>  hash('sha256',Str::random(60))
         ]);
       }
       $a = $user->createToken('MyApp')->accessToken;
       echo $a;
       return $user;
    }
     public function details() 
    { 
        echo "string";
        // $user = Auth::user(); 
        // return response()->json(['success' => $user]); 
    } 
}
