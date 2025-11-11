<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','department_id', 'location_id'
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
     * Backwards compatible wrapper to support legacy role assignment calls.
     *
     * @param  int|string|\Spatie\Permission\Contracts\Role  $role
     * @return void
     */
    public function attachRole($role): void
    {
        $this->assignRole($role);
    }
}

