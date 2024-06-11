<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'principal_id';

    protected $table = 'sys.sql_logins';

    public $timestamps = false;

    protected $hidden = [
        'password_hash', 'sid', 'type', 'type_desc', 'create_date', 'modify_date', 'default_database_name', 'default_language_name', 'credential_id', 'is_policy_checked', 'is_expiration_checked'
    ];

    public function usuarios()
    {
        return $this->belongsTo(Usuarios::class, 'name', 'Segu_Usr_Cuenta');
    }

    public function perfil()
    {
        return $this->belongsTo(Token::class, 'principal_id', 'id_user');
    }

    public function tokenSave()
    {
        return $this->hasOne(Token::class);
    }
    
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user_sistema')->withTimestamps()->withPivot('sistemas_id','vigencia', 'id')->where('vigencia', true);
    }

    public function sistemas()
    {
        return $this->belongsToMany(Sistemas::class, 'role_user_sistema')->withTimestamps()->withPivot('role_id','vigencia')->where('vigencia', true);
    }

    public static function getAuth($username, $sys)
    {
        $per = false;
        $user = User::with('sistemas','usuarios')->where('name', $username)->first();
        if($user->usuarios->Segu_Vigente === "si" )
        {
            foreach ($user->sistemas as $sistema) {
                if($sistema->id === $sys){
                    $per = true;
                }
            }
        }
        
        return $per;
    }

    public static function checkRole ($roles){
        $user = Auth::user()->sistemas->where('id', 8);
        foreach($user as $us)
        {
            return in_array( $us->pivot->role_id, $roles );
        }
    }

    public function scopeName($query, $id)
    {
        if ($id)
            return $query->where('name', 'LIKE', "%$id%");
    }

    public function scopeId($query, $id)
    {
        if ($id)
            return $query->where('principal_id', $id);
    }
}
