<!DOCTYPE html>
<html>
<head>
    <title>Support Ticket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow p-4">

        <h2 class="mb-4">Submit a Support Ticket</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tickets.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Name *</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Email *</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Phone (optional)</label>
                <input type="text" name="phone" class="form-control">
            </div>

            <div class="mb-3">
                <label>Ticket Type *</label>
                <select name="type" class="form-control" required>
                    <option value="">-- Select Type --</option>
                    <option>Technical Issues</option>
                    <option>Account & Billing</option>
                    <option>Product & Service</option>
                    <option>General Inquiry</option>
                    <option>Feedback & Suggestions</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Message *</label>
                <textarea name="message" class="form-control" rows="5" required></textarea>
            </div>

            <button class="btn btn-primary">Submit Ticket</button>

        </form>
    </div>
</div>

</body>
</html>
