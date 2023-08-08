<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\RegistrationFormRequest;


class ApiUserController extends Controller
{
    public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $token = null;

        if (!$token = JWTAuth::attempt($input)) {
            
            return response()->json([
                'success' => false,
                'message' => ' Email ou Senha Incoretos',
            ], 401);
        }

         $usuario_logado = JWTAuth::user();
         
        return response()->json([
            'id'    => $usuario_logado->id,
            'email' => $request->email,
            'nome' => $usuario_logado->nome,
            'success' => true,
            'msg' => "User Logged",
            'token' => $token,
        ]);
    }

    public function register(Request $request)
    {
        $user = new User();
        $user->nome = $request->nome;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();

        return response()->json([
        'success' => true,
         'data' =>  $user
        ]
        );

        
    }

    public function reset(Request $request)
    {

        $user = JWTAuth::user();
        
        dd($user);

        $user->update(['password' => bcrypt($request->password)]);

    }


}
