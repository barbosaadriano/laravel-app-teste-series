<?php

namespace App;

use App\Scopes\EmpresaScope;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function apontamentos()
    {
        return $this->hasMany(Apontamento::class);
    }

    public function empresasGerenciadas()
    {
        return $this->hasMany(Empresa::class);
    }
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    /*
        public function hasPermission(Permission $permission)
    {
        return $this->hasAnyRoles($permission->roles);
    }

    public function hasAnyRoles($roles)
    {
        if (is_array($roles) || is_object($roles)) {
            return !! $roles->intersect($this->roles)->count();
        }
        return $this->roles()->contains('name',$role);
    }
    public function roles()
    {
        return $this->belongsTo(Role::class);
    }
    */

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new EmpresaScope);
    }
}
