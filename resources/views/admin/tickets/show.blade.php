<!DOCTYPE html>
<html>
<head>
    <title>Ticket Details</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>

    <style>
        body { font-family: Arial; margin: 20px; }
        .ticket-box { border: 1px solid #ddd; padding: 20px; border-radius: 6px; }
        .label { font-weight: bold; }
        .note-box { margin-top: 30px; }
        .cke_notifications_area {
            display: none;
        }
    </style>
</head>
<body>

<h2>Ticket Details</h2>

<div class="ticket-box">
    <p><span class="label">Ticket ID:</span> {{ $ticket->ticket_id }}</p>
    <p><span class="label">Customer Name:</span> {{ $ticket->name }}</p>
    <p><span class="label">Email:</span> {{ $ticket->email }}</p>
    <p><span class="label">Phone:</span> {{ $ticket->phone }}</p>
    <p><span class="label">Department:</span> {{ $dept }}</p>
    <p><span class="label">Message:</span> {{ $ticket->message }}</p>
    <p><span class="label">Status:</span> 
        <strong>{{ $ticket->status }}</strong>
    </p>

    @if($ticket->admin_note)
        <h3>Previous Admin Note</h3>
        <div style="border:1px solid #ccc; padding:15px; border-radius:4px;">
            {!! $ticket->admin_note !!}
        </div>
    @endif
</div>

<div class="note-box">
    <h3>Add / Update Admin Note</h3>

    <form action="{{ route('admin.tickets.note', [$ticket->ticket_id, $dept_k]) }}" method="POST">
        @csrf

        <textarea name="admin_note" id="editor" rows="8" required></textarea>

        <script>
            CKEDITOR.replace('editor');
        </script>

        <br>
        <button type="submit" class="btn btn-primary">
            Save Note & Mark as Noted
        </button>
        <a class="btn btn-secondary" href="{{ route('admin.tickets.index') }}">
            Back
        </a>
    </form>
</div>

</body>
</html>
