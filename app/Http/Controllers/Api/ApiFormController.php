<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;
use App\Models\Form;
use JWTAuth;
use App\User;

class ApiFormController extends Controller
{
    public function index()
    {
        
        $form = Form::with('user')->orderBy('id', 'desc')->get();

        return response()->json(
            $form
        );

    }

    public function store(Request $request)
    {

        // $user = auth()->user()->id;
     
        $form = new Form();
       
        $form->user_id       = $request->user_id;
        $form->nome          = $request->nome;
        $form->telefone      = $request->telefone;
        $form->idade         = $request->idade;
        $form->profissao     = $request->profissao;
        $form->finalidade    = $request->finalidade;
        
        
        
        if ($request->photo != null) {
            $salva_file = $request->photo->storeAs('public/municipe', $request->photo->getClientOriginalName());
            $form->photo = $request->photo->getClientOriginalName();
        }
        
        $form->save();

        return response()->json([
            'success'   =>  true,
            'data'      =>  $form
        ],201);
    }
    public function dados()
    {
        $forms = Form::all();

         return response()->json($forms);
    }

}
