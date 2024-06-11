<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use App\Models\User;
use App\Models\Token;
use Illuminate\Support\Str;

class LoginHccProvider implements UserProvider
{
    public function retrieveById($identifier)
    {
        $user = User::with('perfil.unidad', 'usuarios', 'sistemas')->where('principal_id', $identifier)->first();
        if(!$user)
        {
            return null;
        } else {
            Token::firstOrCreate(
                ['id_user' => $identifier],
                ['remember_token' => "123456"]
            );
            return $user;
        }
    }

    public function retrieveByToken($identifier, $token)
    {

    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        Token::updateOrCreate(
            ['id_user' => $user->principal_id],
            ['remember_token' => $token]
        );
    }

    public function retrieveByCredentials(array $credentials)
    {

    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        return true;
    }
}
