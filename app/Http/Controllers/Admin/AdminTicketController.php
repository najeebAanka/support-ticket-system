<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Collection;
use App\Helpers\Department;

class AdminTicketController extends Controller
{
    public function index()
    {
        $departments = Department::list();
        $allTickets = collect();

        foreach ($departments as $key => $department) {

            $tickets = Ticket::on($department['connection'])
                        ->orderBy('created_at', 'desc')
                        ->get();

            foreach ($tickets as $t) {
                $t->dept = $department['label'];
                $t->dept_k = $key;
            }

            $allTickets = $allTickets->merge($tickets);
        }

        $allTickets = $allTickets->sortByDesc('created_at');

        return view('admin.tickets.index', [
            'tickets' => $allTickets
        ]);
    }

    public function show($ticket_id, $dept_key)
    {
        $departments = Department::list();

        $connection = $departments[$dept_key]['connection'] ?? abort(404);
        $deptLabel  = $departments[$dept_key]['label'];

        $ticket = Ticket::on($connection)
            ->where('ticket_id', $ticket_id)
            ->first();

        return view('admin.tickets.show', [
            'ticket' => $ticket,
            'dept' => $deptLabel,
            'dept_k' => $dept_key,
        ]);
    }

    public function addNote(Request $request, $ticket_id, $dept_key)
    {
        $request->validate([
            'admin_note' => 'required|string'
        ]);

        $departments = Department::list();

        $connection = $departments[$dept_key]['connection'] ?? abort(404);

        $ticket = Ticket::on($connection)
                ->where('ticket_id', $ticket_id)
                ->firstOrFail();

        $ticket->admin_note = $request->admin_note;
        $ticket->status = 'Noted';
        $ticket->save();

        return back()->with('success', 'Admin note added successfully!');
    }

}
