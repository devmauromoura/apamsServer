<?php

namespace ApamsServer\Http\Controllers\Auth;

use ApamsServer\User;
use ApamsServer\Staff;
use ApamsServer\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use ApamsServer\Http\Requests\RegisterUser;
use Illuminate\Support\Facades\View;


class RegisterController extends Controller
{

    use RegistersUsers;
    protected $redirectTo = '/home';

    public function register(Request $request)
    {
        $data = $request->all();
        $method = $request->method();

        if($method == 'POST'){
            $validatedData = Validator::make($request->all(), [
                'nameProfile' => 'required',
                'emailProfile' => 'required',
                'passProfile' => 'required',
                'typeAccount' => 'required',
            ]);
            if ($validatedData->fails()) {
                return redirect()->back()->with('msg', 'Envie os dados corretamente!');
            }
            else {
                if(Staff::where('email', $data['emailProfile'])->exists()){
                    return redirect()->back()->with('msg', 'E-mail já cadastrado!');
                }
                else {
                    $registerUser = new Staff;
                    $registerUser->name = $data['nameProfile'];
                    $registerUser->email = $data['emailProfile'];
                    $registerUser->password = Hash::make($data['passProfile']);
                    $registerUser->typeAccount = $data['typeAccount'];
                    $registerUser->save();

                    return redirect()->back()->with('msg', 'Usuário cadastrado!');
                }
            }
        }
        elseif ($method == 'GET') {
            return view('Auth.register');
        }
        else{
            return "Method invalido!";
        }
    }

}
