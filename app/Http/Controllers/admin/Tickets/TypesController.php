<?php

namespace App\Http\Controllers\admin\Tickets;

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
use App\Models\Logs_Users;

class TypesController extends Controller
{
    public function index () {
        $types = Ticket_Types::all();
        return view('admin.types.index', [
            'types' => $types,
        ]);
    }

    public function create(Request $request)
    {
        $valid = $request->validate([
            'name' => 'required',
        ]);
        if(Ticket_Types::where('name', $request->name)->exists()){
            return redirect()->back()->with('warning', 'Le nom du type existe déjà');
        }
        Ticket_Types::create([
            'name' => $request->name,
        ]);
        Logs_Users::create([
            'user_id' => Auth::user()->id,
            'action' => "Créatiuon du type ".$request->name,
        ]);
        return redirect()->back()->with('success', 'Nouveau type crée');
    }

    public function profil (Ticket_Types $id) {
        return view('admin.types.profil', [
            'type' => $id,
        ]);
    }

    public function edit (Ticket_Types $id) {
        return view('admin.types.edit', [
            'type' => $id,
        ]);
    }

    public function editer(Request $request, Ticket_Types $id)
    {
        $valid = $request->validate([
            'name' => 'required',
        ]);
        
        Ticket_Types::where("id", $id->id)->update([
            'name' => $request->name,
        ]);
        Logs_Users::create([
            'user_id' => Auth::user()->id,
            'action' => "Modification du type ".$id->name . " en ".$request->name,
        ]);
        return redirect()->back()->with('success', 'Type modifié');
    }

    public function delete(Ticket_Types $id)
    {
        Ticket_Types::where("id", $id->id)->delete();
        Logs_Users::create([
            'user_id' => Auth::user()->id,
            'action' => "Suppression du type ".$id->name,
        ]);
        return redirect()->route('admin.types.index')->with('success', 'Type supprimé');
    }
}
