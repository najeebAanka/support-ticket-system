<!DOCTYPE html>
<html>
<head>
    <title>All Tickets</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <style>
        table.dataTable.no-footer {
            padding-top: 25px;
        }
    </style>
</head>
<body class="bg-light p-4">

<div class="container">

    <div class="d-flex flex-row justify-content-between mb-4">
        <h2>All Support Tickets</h2>
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-secondary">
                Logout
            </button>
        </form>
    </div>

    

    <div class="table-responsive">
        <table id="ticketsTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Ticket ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Status</th>
                    <th>Submitted</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($tickets as $t)
                    <tr>
                        <td>{{ $t->ticket_id }}</td>
                        <td>{{ $t->name }}</td>
                        <td>{{ $t->email }}</td>
                        <td>{{ $t->dept }}</td>
                        <td>{{ $t->status }}</td>
                        <td>{{ $t->created_at }}</td>
                        <td>
                            <a class="btn btn-primary btn-sm"
                            href="{{ route('admin.tickets.show', [$t->ticket_id, $t->dept_k]) }}">
                                View
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script 
    src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js">
</script>

<script>
    $(document).ready(function(){
        $('#ticketsTable').DataTable();
    });
</script>

</body>
</html>
