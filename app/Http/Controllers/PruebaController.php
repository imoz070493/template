<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\User;

class PruebaController extends Controller
{
    public function index(){

    	$user = User::first();
		if($user->hasPermissionTo(Permission::find(1))){
			$result = [
	            'username' => $user->name,
	            'rol' => $user->getRoleNames(),
	            // 'permisos1' => $user->getDirectPermissions(),
	            // 'permisos2' => $user->getPermissionsViaRoles(),
	            'permisos3' => $user->getAllPermissions(),
	        ];

	        return response()->json($result);	
		}
    }

	public function create(){
		
    }

    public function update(){

    }

    public function delete(){
    	
    }

}
