<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthControllerApi extends Controller
{
    use HasApiTokens;

    public function register(Request $request)
    {
        $email = $request->email;
        $contraseña = $request->password;
        $nombre = $request->name;
    
        $existeUsuario = User::where('email', $email)->first();

        if (!$existeUsuario){
            $hashContraseña = Hash::make($contraseña);
            User::agregarUsuario($email,$hashContraseña,$nombre);

            return response()->json(
                [
                    'success' => 'Nuevo usuario creado correctamente',
                ], 201);
        }
        else {
            return response()->json(
                [
                    'error' => 'No se creo el nuevo usuario, ya existe un usuario con ese email asociado',
                ], 400);
        }
    }

    public function login(Request $request)
    {
        // Validar las credenciales del usuario
        if (!auth()->attempt($request->only('email', 'password'))) {
            return response()->json(
                [
                    'message' => 'Nombre de usuario o contraseña incorrectas',
                    'emailSent' => $request->email,
                    'passWordSent' => $request->password,
                ], 401);
        }
        // Generar y devolver el token de acceso, y nombre e email
        $token = auth()->user()->createToken('token-name')->plainTextToken;
        $user = auth()->user();

        return response()->json(
            [
                'message' => 'Sesion iniciada correctamente',
                'access_token' => $token,
                'user_name' => $user->name,
                'user_email' => $user->email,
            ], 201);
    }

    public function logout(Request $request)
    {
        $user = auth()->user();

        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();

        return response()->json(['message' => 'Sesión cerrada correctamente'], 200);
    }

/* 
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $response = Password::sendResetLink(
            $request->only('email')
        );

        return $response == Password::RESET_LINK_SENT
            ? response()->json(['message' => 'Correo electrónico de restablecimiento de contraseña enviado'])
            : response()->json(['message' => 'No se pudo enviar el correo electrónico de restablecimiento de contraseña'], 400);
    } */ 
}
