<?php

namespace App\Http\Controllers\admin\Configurations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Projects;
use App\Models\Ticket_Tickets;
use App\Models\Ticket_Messages;
use App\Models\Ticket_Times;
use App\Models\Ticket_Types;
use App\Models\Roles;
use App\Models\Permissions_Roles;
use App\Models\Roles_Permissions;
use App\Models\Users_Permissions;
use App\Models\Logs_Users;

class RolesController extends Controller
{
    public function index () {
        $permissions = Permissions_Roles::all();
        $sections = Permissions_Roles::where('route', 'like', 'admin.%')->get()->map(function ($admin) {
                return explode('.', str_replace('admin.', '', $admin->route))[0];
            })->unique()->values();
        $tries = [];
        foreach ($sections as $key => $section) {
            $tries[$key]["name"] = $section;
            $tries[$key]["count"] = Permissions_Roles::where('route', 'like', "admin.$section.%")->count();
            $tries[$key]["perm"] = Permissions_Roles::where('route', 'like', "admin.$section.%")->get();
        }
        $roles = Roles::all();
        return view('admin.roles.index', [
            'roles' => $roles,
            'sections' => json_decode(json_encode($tries)),
        ]);
    }

    public function create(Request $request)
    {
        // return $request;
        $valid = $request->validate([
            'name' => 'required',
            'color' => 'required',
        ]);
        if(Roles::where('name', $request->name)->exists()){
            return redirect()->back()->with('warning', 'Le nom du role existe déjà');
        }
        Roles::create([
            'name' => $request->name,
            'color' => $request->color,
        ]);
        $role_id = Roles::where('name', $request->name)->first()->id;
        foreach ($request->perm as $key => $permission) {
            $permission_id = Permissions_Roles::where('id', $permission)->first()->id;
            Roles_Permissions::create([
                'role_id' => $role_id,
                'permission_id' => $permission_id,
            ]);
        }
        Logs_Users::create([
            'user_id' => Auth::user()->id,
            'action' => "Creation du role ".$request->name,
        ]);
        return redirect()->back()->with('success', 'Nouveau role crée');
    }

    public function profil (Roles $id) {
        return view('admin.roles.profil', [
            'role' => $id,
        ]);
    }

    public function users (Roles $id) {
        $users = User::where('role_id', $id->id)->get();
        return view('admin.roles.users', [
            'role' => $id,
            'users' => $users,
        ]);
    }

    public function edit (Roles $id) {
        return view('admin.roles.edit', [
            'role' => $id,
        ]);
    }

    public function editer(Request $request, Roles $id)
    {
        $valid = $request->validate([
            'name' => 'required',
            'color' => 'required',
        ]);
        $edit = "";
        if($request->color != $id->color)
            $edit = "Modification de la couleur du role ".$id->name." de ".$id->color." en ".$request->color;
        if($request->name != $id->name){
            if($request->color != $id->color){
                $edit = "Modification du role ".$id->name." en ".$request->name. " ainsi que la couleur de ".$id->color." en ".$request->color;
            }else {
                $edit = "Modification du role ".$id->name." en ".$request->name;
            }
        }
        Roles::where("id", $id->id)->update([
            'name' => $request->name,
            'color' => $request->color,
        ]);
        Logs_Users::create([
            'user_id' => Auth::user()->id,
            'action' => $edit,
        ]);
        return redirect()->back()->with('success', 'Role modifié');
    }

    public function delete(Roles $id)
    {
        if($id->id == 1) return redirect()->back()->with('error', 'Impossible de supprimer le rôle administrateur');
        if(User::where('role_id', $id->id)->count() != 0) return redirect()->back()->with('warning', 'Impossible de supprimer le rôle, il y a des utilisateurs avec ce rôle');
        Roles_Permissions::where('role_id', $id->id)->delete();
        Roles::where("id", $id->id)->delete();
        Logs_Users::create([
            'user_id' => Auth::user()->id,
            'action' => "Suppression du role ".$id->name,
        ]);
        
        return redirect()->route('admin.roles.index')->with('success', 'Role supprimé');
    }
}
