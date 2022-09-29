<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    //
    public function list(){
        $role = Role::create(['name' => 'admin2']);
        $permission = Permission::create(['name' => 'edit product']);
        $permission->assignRole($role);
        return view('welcome');
    }
}
