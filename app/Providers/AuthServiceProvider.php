<?php

namespace App\Providers;

use App\Permission;
use App\User;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         //\App\User::class => \App\Policies\UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(Gate $gate)
    {
        $this->registerPolicies();

        /*
        $permissions = Permission::with('roles')->get();
        foreach($permissions as $permission) {
            $gate->define($permission->name,function(User $user) use ($permission){
                return $user->hasPermission($permission);
            });
        }
        $gate->before(function(User $user,$ability){
            if ($user->hasAnyRoles('admin') ) {
                return true;
            }
        });
        */
    }
}
