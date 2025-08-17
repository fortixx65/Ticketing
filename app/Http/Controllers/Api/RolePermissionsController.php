<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Roles;
use App\Models\Permissions_Roles;
use App\Models\Roles_Permissions;
use App\Models\Users_Permissions;
use App\Models\Logs_Users;

class RolePermissionsController extends Controller
{
    public function update(Request $request){
        $status = $request->input('status'); // true ou false
        $roleId = $request->input('role_id'); // Id de la permission (à récupérer dynamiquement)
        $permissionId = $request->input('permission_id'); // Id de la permission (à récupérer dynamiquement)
        $userId = $request->input('user_id'); // Id de l'utilisateur (à récupérer dynamiquement)
        $roleName = Roles::where('id', $roleId)->first()->name;
        $permissionName = Permissions_Roles::where('id', $permissionId)->first()->name;

        if ($status === "true") {
            // 🔹 Créer une ligne en BDD si elle n'existe pas
            Roles_Permissions::firstOrCreate([
                'role_id' => $roleId,
                'permission_id' => $permissionId
            ]);
            Logs_Users::create([
                'user_id' => $userId,
                'action' => "Ajout de la permission ".$permissionName . " pour le role ".$roleName,
            ]);
            return response()->json(['message' => 'Permission ajoutée avec succès !', 'status' => 1]);
        } else {
            // 🔹 Supprimer la ligne si elle existe
            Roles_Permissions::where('role_id', $roleId)->where('permission_id', $permissionId)->delete();
            Logs_Users::create([
                'user_id' => $userId,
                'action' => "Retrait de la permission ".$permissionName . " pour le role ".$roleName,
            ]);
            return response()->json(['message' => 'Permission supprimée avec succès !', 'status' => 1]);
        }

    }
}
