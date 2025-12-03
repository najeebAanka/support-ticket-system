<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email',
            'phone'  => 'nullable|string|max:20',
            'type'   => 'required',
            'message'=> 'required|string',
        ]);

        $ticketId = 'TCK-' . date('Ymd') . '-' . strtoupper(Str::random(6));

        $ticket = Ticket::onDepartment($request->type)->create([
            'ticket_id' => $ticketId,
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'type'      => $request->type,
            'message'   => $request->message,
        ]);

        return back()->with('success', "Your ticket has been submitted! Ticket ID: $ticketId");
    }
}
