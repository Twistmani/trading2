<?php

namespace App;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    /**
     * Maintain compatibility with legacy Entrust APIs.
     *
     * @param  int|string|\Spatie\Permission\Contracts\Permission  $permission
     * @return void
     */
    public function attachPermission($permission): void
    {
        $this->givePermissionTo($permission);
    }
}
