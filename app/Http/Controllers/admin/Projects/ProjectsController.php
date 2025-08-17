<?php

namespace App\Http\Controllers\admin\Projects;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Projects;
use App\Models\Ticket_Tickets;
use App\Models\Ticket_Messages;
use App\Models\Ticket_Times;
use App\Models\Ticket_Types;
use App\Models\Roles;
use App\Models\Projects_Acces;
use App\Models\Logs_Users;

class ProjectsController extends Controller
{
    public function index () {
        $projects = Projects::get();
        $roles = Roles::all();
        // return $projects;
        return view('admin.projects.index', [
            'projects' => $projects,
            'roles' => $roles,
        ]);
    }

    public function create(Request $request)
    {
        $valid = $request->validate([
            'name' => 'required',
            'content' => 'required',
        ]);
        return $request;
        if(Projects::where('name', $request->name)->exists()) {
            return redirect()->back()->with('warning', 'Le nom du projet existe déjà');
        }

        $donnees = $request->selected_roles; // Exemple: "10,11,12,13,15"
        $tableau = explode(",", $donnees);
        $tableau = array_map('intval', $tableau);
        sort($tableau);

        // return $tableau;
        Projects::create([
            'name' => $request->name,
            'content' => $request->content,
        ]);
        $project_id = Projects::where('name', $request->name)->first()->id;
        foreach ($tableau as $key => $role) {
            Projects_Acces::create([
                'role_id' => $role,
                'project_id' => $project_id,
            ]);
        }
        Logs_Users::create([
            'user_id' => Auth::user()->id,
            'action' => "Création du projet ".$request->name,
        ]);
        return redirect()->back()->with('success', 'Nouveau projet crée');
    }

    public function action (Projects $id) {

        return view('admin.projects.action', [
            'project' => $id,
        ]);
    }

    public function tickets (Projects $id) {
        $count = Ticket_Tickets::where('project_id', $id->id)->count();
        $tickets_project = Ticket_Tickets::where('project_id', $id->id)->get();
        return view('admin.projects.tickets', [
            'project' => $id,
            'count' => $count,
            'tickets_project' => $tickets_project,
        ]);
    }

    public function permissions (Projects $id) {

        return view('admin.projects.permissions', [
            'project' => $id,
        ]);
    }

    public function edit (Projects $id) {
        $roles = Roles::all();
        $project_id = $id->id;
        $sql = Projects_Acces::where('project_id', $id->id)->get();
        $selectedRoles = [];
        foreach ($sql as $key => $value) {
            $selectedRoles[$key]["name"] = $value->role->name;
            $selectedRoles[$key]["id"] = $value->role->id;
        }
        // return $selectedRoles;
        return view('admin.projects.edit', [
            'project' => $id,
            'roles' => $roles,
            'selectedProjects' => $id->id,
            'selectedRoles' => $selectedRoles,
        ]);
    }

    public function editer(Request $request, Projects $id)
    {
        $valid = $request->validate([
            'name' => 'required',
            'content' => 'required',
        ]);
        // return $request;
        if($request->selected_roles == null) return redirect()->back()->with('warning', 'Aucune role sélectionnée');
        Projects::where("id", $id->id)->update([
            'name' => $request->name,
            'content' => $request->content,
        ]);
        
        Projects_Acces::where('project_id', $id->id)->delete();

        $donnees = $request->selected_roles;
        $tableau = explode(",", $donnees);
        $tableau = array_map('intval', $tableau);
        sort($tableau);

        foreach($tableau as $role) {
            if(Projects_Acces::where('role_id', $role)->where('project_id', $id->id)->doesntExist()) {
                Projects_Acces::create([
                    'role_id' => $role,
                    'project_id' => $id->id,
                ]);
            }
        }
    
        return redirect()->back()->with('success', 'Projet modifié');
    }

    public function on(Projects $id)
    {
        Projects::where("id", $id->id)->update([
            'status' => 1,
        ]);
        Logs_Users::create([
            'user_id' => Auth::user()->id,
            'action' => "Modification de l'etat du projet ".$id->name." en ouvert",
        ]);
        return redirect()->back()->with('success', 'Projet activé');
    }

    public function off(Projects $id)
    {
        Projects::where("id", $id->id)->update([
            'status' => 0,
        ]);
        Logs_Users::create([
            'user_id' => Auth::user()->id,
            'action' => "Modification de l'etat du projet ".$id->name." en clos",
        ]);
        return redirect()->back()->with('success', 'Projet désactivé');
    }

    public function delete(Projects $id)
    {
        // return $id;
        $tickets = Ticket_Tickets::where('project_id', $id->id)->get();
        foreach ($tickets as $ticket) {
            $messages = Ticket_messages::where('ticket_id', $ticket->id)->get();
            $times = Ticket_Times::where('ticket_id', $ticket->id)->get();
            foreach ($messages as $message) {
                Ticket_messages::where('id', $message->id)->delete();
            }
            foreach ($times as $time) {
                Ticket_Times::where('id', $time->id)->delete();
            }
            Ticket_Tickets::where('id', $ticket->id)->delete();
        }
        Projects_Acces::where('project_id', $id->id)->delete();
        Projects::where("id", $id->id)->delete();
        Logs_Users::create([
            'user_id' => Auth::user()->id,
            'action' => "Suppression du projet ".$id->name,
        ]);
        return redirect()->route('admin.projects.index')->with('success', 'Projet supprimé');
    }  
}
