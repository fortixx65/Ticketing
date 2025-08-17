<?php

namespace App\Http\Controllers\admin\Tickets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Projects;
use App\Models\Ticket_Tickets;
use App\Models\Ticket_Messages;
use App\Models\Ticket_Times;
use App\Models\Ticket_Types;
use App\Models\Ticket_Priority;
use App\Models\Roles;
use App\Models\Logs_Users;

class TicketsController extends Controller
{
    public function index () {
        $tickets = Ticket_Tickets::get();
        $types = Ticket_Types::get();
        $procjects = Projects::get();
        $priority = Ticket_Priority::get();
        return view('admin.tickets.index', [
            'tickets' => $tickets,
            'types' => $types,
            'projects' => $procjects,
            'priority' => $priority,
        ]);
    }

    public function create(Request $request)
    {
        //return $request;
        $valid = $request->validate([
            'project' => 'required',
            'type' => 'required',
            'content' => 'required',
        ]);
        Ticket_Tickets::create([
            'user_id' => Auth::user()->id,
            'content' => $request->content,
            'type_id' => $request->type,
            'project_id' => $request->project,
            'priority_id' => $request->priority,
        ]);
        Logs_Users::create([
            'user_id' => Auth::user()->id,
            'action' => "Créatiuon du ticket ".$request->name,
        ]);
        return redirect()->back()->with('success', 'Nouveau ticket crée');
    }

    public function action (Ticket_Tickets $id) {
        return view('admin.tickets.action', [
            'ticket' => $id,
        ]);
    }

    public function messages (Ticket_Tickets $id) {
        $count = Ticket_Messages::where('ticket_id', $id->id)->count() + 1;
        $messages = Ticket_Messages::where('ticket_id', $id->id)->get();
        return view('admin.tickets.messages', [
            'ticket' => $id,
            'count' => $count,
            'messages' => $messages,
        ]);
    }

    public function project (Ticket_Tickets $id) {
        $project = Projects::where('id', $id->project_id)->first();
        // return $project;
        return view('admin.tickets.project', [
            'ticket' => $id,
            'project' => $project,
        ]);
    }

    public function edit (Ticket_Tickets $id) {
        $types = Ticket_Types::get();
        $procjects = Projects::get();
        $priority = Ticket_Priority::get();
        return view('admin.tickets.edit', [
            'ticket' => $id,
            'types' => $types,
            'projects' => $procjects,
            'priority' => $priority,
        ]);
    }

    public function editer(Request $request, Ticket_Tickets $id)
    {
        $valid = $request->validate([
            'content' => 'required',
        ]);
        // return $id;
        $typeEdit = "";
        $priorityEdit = "";
        $projectEdit = "";
        $contentEdit = "";
        $type = Ticket_Types::where('id', $request->type)->first();
        $priority = Ticket_Priority::where('id', $request->priority)->first();
        $project = Projects::where('id', $request->project)->first();
        if($request->type != $id->type_id)
            $typeEdit = "Type : ".$id->type->name . " en ".$type->name." | ";
        if($request->priority != $id->priority_id)
            $priorityEdit = "Priorité : ".$id->priority->name . " en ".$priority->name." | ";
        if($request->project != $id->project_id)
            $projectEdit = "Projet : ".$id->project->name . " en ".$project->name." | ";
        if($request->content != $id->content)
            $contentEdit = "Contenu : ".$id->content." en ".$request->content;
        Ticket_Tickets::where("id", $id->id)->update([
            'type_id' => $request->type,
            'priority_id' => $request->priority,
            'project_id' => $request->project,
            'content' => $request->content,
        ]);
        Logs_Users::create([
            'user_id' => Auth::user()->id,
            'action' => "Modification du ticket ".$id->id." ".$typeEdit.$priorityEdit.$projectEdit.$contentEdit,
        ]);
        return redirect()->back()->with('success', 'ticket modifié');
    }

    public function open(Ticket_Tickets $id)
    {
        Ticket_Tickets::where("id", $id->id)->update([
            'status' => 0,
        ]);
        Logs_Users::create([
            'user_id' => Auth::user()->id,
            'action' => "Modification de l'etat du ticket ".$id->id." en ouvert",
        ]);
        return redirect()->back()->with('success', 'Ticket réouvert');
    }

    public function close(Ticket_Tickets $id)
    {
        Ticket_Tickets::where("id", $id->id)->update([
            'status' => 2,
        ]);
        Logs_Users::create([
            'user_id' => Auth::user()->id,
            'action' => "Modification de l'etat du ticket ".$id->id." en clos",
        ]);
        return redirect()->back()->with('success', 'Ticket clos');
    }

    public function delete(Ticket_Tickets $id)
    {
        // return $id;
        $messages = Ticket_messages::where('ticket_id', $id->id)->get();
        foreach ($messages as $message) {
            Ticket_messages::where('id', $message->id)->delete();
        }
        $times = Ticket_Times::where('ticket_id', $id->id)->get();
        foreach ($times as $time) {
            Ticket_Times::where('id', $time->id)->delete();
        }
        Ticket_Tickets::where("id", $id->id)->delete();
        Logs_Users::create([
            'user_id' => Auth::user()->id,
            'action' => "Suppression du ticket ".$id->id,
        ]);
        
        return redirect()->route('admin.tickets.index')->with('success', 'Ticket supprimé');
    }  
}
