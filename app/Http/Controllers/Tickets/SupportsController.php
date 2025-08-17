<?php

namespace App\Http\Controllers\Tickets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Projects;
use App\Models\Ticket_Tickets;
use App\Models\Ticket_Messages;
use App\Models\Ticket_Times;
use App\Models\Ticket_Types;
use App\Models\Roles;

class SupportsController extends Controller
{
    public function index () {
        $projects = Ticket_Projects::get();
        return view('tickets.supports.index', [
            'projects' => $projects,
        ]);
    }

    public function news (Ticket_Projects $id) {
        $tickets = Ticket_Tickets::where('status', 0)->get();
        return view('tickets.supports.new', [
            'project' => $id,
            'tickets' => $tickets,
        ]);
    }

    public function in_progress (Ticket_Projects $id) {
        $tickets = Ticket_Tickets::where('status', 1)->get();
        return view('tickets.supports.in_progress', [
            'project' => $id,
            'tickets' => $tickets,
        ]);
    }

    public function acquit (Ticket_Tickets $id) {
        $posts = Ticket_Messages::where('ticket_id', $id->id)->get();
        Ticket_Tickets::where("id", $id->id)->update([
            'status' => 1,
        ]);
        return view('tickets.supports.ticket_Open', [
            'ticket' => $id,
            'posts' => $posts,
        ]);
    }

    public function view (Ticket_Tickets $id) {
        $posts = Ticket_Messages::where('ticket_id', $id->id)->get();
        return view('tickets.supports.ticket_Open', [
            'ticket' => $id,
            'posts' => $posts,
        ]);
    }

    public function message_Add (Request $request, Ticket_Tickets $id)
    {
        // return $request;
        $content = $request["content"];
        $count = Ticket_Messages::where('ticket_id', $id->id)->count()+2;
        // return $count;
        Ticket_Messages::create([
            'user_id' => Auth::user()->id,
            'ticket_id' => $id->id,
            'content' => $content,
            'count' => $count,
        ]);
        return redirect()->back()->with('success', trans('Nouveau message ajouté'));
    }
    
}
