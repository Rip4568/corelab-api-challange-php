<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index() {
        return response()->json(["Users" => "pra que você quer ver todos os usuarios ?"]);
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $rememberMe = $request['remember-me'] ? true : false;
        if (Auth::attempt($credentials, $rememberMe)) {
            // Login bem-sucedido, redirecionar para a página desejada
            $user = Auth::user();
            $token = $user->createToken("token")->plainTextToken;
            return response()->json(["message" => "Login bem-sucedido", "user" => $user, "token" => $token]);
        }
        // Login falhou, retornar um erro
        return back()->withErrors([
            'email' => 'As credenciais fornecidas não são válidas.',
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(StoreUserRequest $request) # esse metodo pode ser lido como signup, pois se trata da criação de um novo usuario
    {
        
        $user = User::create($request->all());

        
        return response()->json([
            "message" => "Usuario criado com sucesso",
            "user" => $user
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json(["user" => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        return response()->json(["message" => "Usuario atualizado com sucesso", "user" => $user]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(["message" => "Usuario deletado com sucesso"]);
    }
}
