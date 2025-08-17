<?php

namespace App\Http\Controllers\admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Carbon\Carbon;
use App\Models\Logs_Users;

class UsersController extends Controller
{
    public function index () {
        $users = User::get();
        $roles = Roles::all();
        return view('admin.users.index', [
            'users' => $users,
            'roles' => $roles,
        ]);
    }

    public function create(Request $request)
    {
        // return $request;
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'integer'],
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role,
            'expired' => $request->expired,
        ]);
        Logs_Users::create([
            'user_id' => Auth::user()->id,
            'action' => "Creation de l'utilisateur ".$request->name,
        ]);

        return redirect()->back()->with('success', 'Nouveau projet crée');
    }

    public function profil (User $id) {
        return view('admin.users.profil', [
            'user' => $id,
        ]);
    }

    public function logs (User $id) {
        $logs = Logs_Users::where('user_id', $id->id)->get();
        return view('admin.users.logs', [
            'user' => $id,
            'logs' => $logs,
        ]);
    }

    public function edit (User $id) {
        $roles = Roles::all();
        $date = Carbon::parse($id->expired)->locale('fr_FR')->isoFormat('DD MMMM Y');
        // return $date;
        if ($id->expired != null) {
            if ($id->expired <= Carbon::now()->isoFormat('Y-MM-DD')) {
                User::where("id", $id->id)->update([
                    'status' => 0,
                    'expired' => null,
                ]);
            }
        }
        if ($id->status == 0) {
            User::where("id", $id->id)->update([
                'expired' => null,
            ]);
        }
        return view('admin.users.edit', [
            'user' => $id,
            'roles' => $roles,
            'date' => $date,
        ]);
    }

    public function editer(Request $request, User $id)
    {
        // return $request;
        if ($id->status == 0) {
            if ($request->expired != null) {
            return redirect()->back()->with('warning', 'Utilisateur désactivé');
            }
        }
        $valid = $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        
        User::where("id", $id->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role,
            'expired' => $request->expired,
        ]);
        Logs_Users::create([
            'user_id' => Auth::user()->id,
            'action' => "Modification de l'utilisateur ".$id->name . " en ".$request->name,
        ]);
        return redirect()->back()->with('success', 'User modifié');
    }

    public function on(User $id)
    {
        User::where("id", $id->id)->update([
            'status' => 1,
        ]);
        Logs_Users::create([
            'user_id' => Auth::user()->id,
            'action' => "Modification de l'utilisateur ".$id->name." en actif",
        ]);
        return redirect()->back()->with('success', 'Utilisateur activé');
    }

    public function off(User $id)
    {
        User::where("id", $id->id)->update([
            'status' => 0,
            'expired' => null,
        ]);
        Logs_Users::create([
            'user_id' => Auth::user()->id,
            'action' => "Modification de l'utilisateur ".$id->name." en inactif",
        ]);
        return redirect()->back()->with('success', 'Utilisateur désactivé');
    }

    public function delete(User $id)
    {
        User::where("id", $id->id)->delete();
        Logs_Users::create([
            'user_id' => Auth::user()->id,
            'action' => "Suppression de l'utilisateur ".$id->name,
        ]);
        return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé');
    }
}
