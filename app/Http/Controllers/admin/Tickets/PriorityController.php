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
use App\Models\Ticket_Priority;
use App\Models\Roles;
use App\Models\Logs_Users;

class PriorityController extends Controller
{
    public function index () {
        $priority = Ticket_Priority::all();
        return view('admin.priority.index', [
            'priority' => $priority,
        ]);
    }

    public function create(Request $request)
    {
        $valid = $request->validate([
            'name' => 'required',
        ]);
        if(Ticket_Priority::where('name', $request->name)->exists()){
            return redirect()->back()->with('warning', 'Le nom de la priorité existe déjà');
        }
        Ticket_Priority::create([
            'name' => $request->name,
        ]);
        Logs_Users::create([
            'user_id' => Auth::user()->id,
            'action' => "Création de la priorité ".$request->name,
        ]);
        return redirect()->back()->with('success', 'Nouvelle priorité crée');
    }

    public function action (Ticket_Priority $id) {
        return view('admin.priority.action', [
            'priority' => $id,
        ]);
    }

    public function edit (Ticket_Priority $id) {
        return view('admin.priority.edit', [
            'priority' => $id,
        ]);
    }

    public function editer(Request $request, Ticket_Priority $id)
    {
        $valid = $request->validate([
            'name' => 'required',
        ]);
        if(Ticket_Priority::where('name', $request->name)->exists()){
            return redirect()->back()->with('warning', 'Le nom de la priorité existe déjà');
        }
        Ticket_Priority::where("id", $id->id)->update([
            'name' => $request->name,
        ]);
        Logs_Users::create([
            'user_id' => Auth::user()->id,
            'action' => "Modification de la priorité ".$id->name . " en ".$request->name,
        ]);
        return redirect()->back()->with('success', 'Type modifié');
    }

    public function delete(Ticket_Priority $id)
    {
        Ticket_Priority::where("id", $id->id)->delete();
        Logs_Users::create([
            'user_id' => Auth::user()->id,
            'action' => "Suppression de la priorité ".$id->name,
        ]);
        return redirect()->route('admin.priority.index')->with('success', 'Priorité supprimé');
    }
}
