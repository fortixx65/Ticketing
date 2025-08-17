<?php

namespace App\Http\Controllers\admin\Permissions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Roles;
use App\Models\Permissions_Roles;
use App\Models\Roles_Permissions;
use App\Models\Uers_Permissions;

class RolePermissionsController extends Controller
{
    public function index () {
        $permissions = Permissions_Roles::all();
        return view('admin.permissions.roles.index', [
            'permissions' => $permissions,
        ]);
    }

    public function create(Request $request)
    {
        $valid = $request->validate([
            'name' => 'required',
            'route' => 'required',
        ]);
        if(Permissions_Roles::where('name', $request->name)->exists()){
            return redirect()->back()->with('warning', 'Le nom de la permission existe déjà');
        }
        if(Permissions_Roles::where('route', $request->route)->exists()){
            return redirect()->back()->with('warning', 'Cette route existe déjà');
        }
        Permissions_Roles::create([
            'name' => $request->name,
            'route' => $request->route,
        ]);
        return redirect()->back()->with('success', 'Nouvelle permission crée');
    }

    public function profil (Permissions_Roles $id) {
        return view('admin.permissions.roles.profil', [
            'permission' => $id,
        ]);
    }

    public function edit (Permissions_Roles $id) {
        return view('admin.permissions.roles.edit', [
            'permission' => $id,
        ]);
    }

    public function editer(Request $request, Permissions_Roles $id)
    {
        $valid = $request->validate([
            'name' => 'required',
            'route' => 'required',
        ]);
        if ($id->name != $request->name){
            if(Permissions_Roles::where('name', $request->name)->exists()) return redirect()->back()->with('warning', 'Le nom de la permission existe déjà');  
        }
        
        if($id->route != $request->route){
            if(Permissions_Roles::where('route', $request->route)->exists()) return redirect()->back()->with('warning', 'Cette route existe déjà');
        }
        
        Permissions_Roles::where("id", $id->id)->update([
            'name' => $request->name,
            'route' => $request->route,
        ]);
        return redirect()->back()->with('success', 'Permission modifié');
    }

    public function delete(Permissions_Roles $id)
    {
        Permissions_Roles::where("id", $id->id)->delete();
        return redirect()->route('admin.permissions.roles.index')->with('success', 'Permission supprimé');
    }

    public function permission (Roles $id) {
        $permissions = Permissions_Roles::all();
        $users = User::all();
        
        $sections = Permissions_Roles::where('route', 'like', 'admin.%')->get()->map(function ($admin) {
                return explode('.', str_replace('admin.', '', $admin->route))[0];
            })->unique()->values();
        $adminPermissions = Permissions_Roles::where('route', 'like', "admin.%")->get();
        // return $adminPermissions;
        $tries = [];
        foreach ($sections as $key => $section) {
            $tries[$key]["name"] = $section;
            $tries[$key]["count"] = Permissions_Roles::where('route', 'like', "admin.$section.%")->count();
            $permissionsList = Permissions_Roles::where('route', 'like', "admin.$section.%")->get();
            $tries[$key]["perm"] = $permissionsList->map(function ($perm) use ($id) {
                $perm->exist = Roles_Permissions::where('role_id', $id->id)
                    ->where('permission_id', $perm->id)
                    ->exists();
                return $perm;
            });
        }
        // return $tries;
        return view('admin.roles.permission', [
            'role' => $id,
            'permissions' => $permissions,
            'sections' => json_decode(json_encode($tries)),
            'users' => $users,
        ]);
    }
}
