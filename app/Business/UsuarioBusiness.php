<?php

namespace App\Business;

// Models
use App\Models\Usuario;
// Utils
use App\Utils\JwtToken;
use Illuminate\Support\Facades\Hash;

//Models

/**
 * Clase de negocios del usuario
 *
 * Created by Edewaldo Nuñez.
 * Date: 15 Jun 2020
 */
class UsuarioBusiness
{


     /**
     *  valida que el usuario exista en el sistema
     *
     * @return \App\Model\Usuario
     */
    public static function fnLoginUser($username,$password)
    {
        
        // Encuentra usuario de la base de datos
        $user = Usuario::where('email', $username)->first();
  
        //verifica si el usuario existe con email
        if (!$user)
            $user = Usuario::where('username', $username)->first();
        
        // verifica si el usuario existe sino responde con error
        if (!$user) 
            return false;
        
        // Verifica la contraseña y genera un token sino responde con error
        if (!Hash::check($password, $user->password)) 
            return false;
        
        // Se actualiza la última vez que inició sesión el usuario
        $user->ultima_conexion = date("Y-m-d H:i:s");
        $user->push();

        // El usuario es válido. se asigna a el resultado el token.
        $user['token'] = JwtToken::create($user);

        return $user;
    }
}
