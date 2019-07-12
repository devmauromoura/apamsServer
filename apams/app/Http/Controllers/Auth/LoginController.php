<?php

namespace ApamsServer\Http\Controllers\Auth;

use ApamsServer\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use ApamsServer\User;
use Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

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

//    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
//    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //        $this->middleware('guest')->except('logout');
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function redirect()
    {
        return Socialite::driver('google')
                        ->scopes(config('google.scopes'))
                        ->with([
                            'access_type'     => config('google.access_type'),
                            'approval_prompt' => config('google.approval_prompt'),
                        ])
                        ->redirect();
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function callback()
    {
        if (!request()->has('code')) {
            return redirect('/home');
        }

        /**
         * @var \Laravel\Socialite\Two\User $user
         */
        $user = Socialite::driver('google')->user();

        /**
         * @var \ApamsServer\User $loginUser
         */
        $loginUser = User::updateOrCreate(
            [
                'email' => $user->email,
            ],
            [
                'name'          => $user->name,
                'email'         => $user->email,
                'access_token'  => $user->token,
                'refresh_token' => $user->refreshToken,
                'expires_in'    => $user->expiresIn,
                'typeAccount' => 0,
                'activeAccount' => 0,
                'google' => 1,
            ]);

        auth()->login($loginUser, false);

        return redirect('/home');
    }

    public function logout()
    {
        auth()->logout();

        return redirect('/');
    }


    public function index(){
        if(Auth::check()){
            return redirect('home');
        }else{
            return View::make('login');
        }
    }

    protected function login(Request $request){

                if(Auth::attempt(['email' => $request['email'], 'password' => $request['password']])){
                    return redirect('home');
                }else{
                   return redirect('/')->with('error', 'Verifique suas credenciais!');
                    }
    }

    protected function loginapi(Request $request){
        if(Auth::attempt(['email' => $request['email'], 'password' => $request['password']])){
            $user = Auth::user();
            $token =  $user->createToken('token'.$user->id)->accessToken;

            //return response()->json($token);
            return response()->json(['return' => 'Login efetuado com sucesso', 'token'=> $token,'cellphone' => $user->cellphone], 200);
        }else{
            return response()->json(['return' => 'Falha, verifique suas credenciais e tente novamente.'], 401);
            //return response()->json(['return'=> $request->all()]);
        }
    }

}
