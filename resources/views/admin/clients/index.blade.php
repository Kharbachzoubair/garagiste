@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-md-12">
            <input type="text" id="search" class="form-control" placeholder="Search Clients">
        </div>
    </div>
    <div class="row" id="client-list">
        @foreach ($clients as $client)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $client->name }}</h5>
                        <p class="card-text">{{ $client->email }}</p>
                        <a href="{{ route('admin.clients.edit', $client->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('admin.clients.destroy', $client->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this client?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            var query = $(this).val();

            $.ajax({
                url: "{{ route('admin.clients.index') }}",
                type: 'GET',
                data: { search: query },
                success: function(data) {
                    $('#client-list').html('');
                    data.forEach(client => {
                        $('#client-list').append(`
                            <div class="col-md-4">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title">${client.name}</h5>
                                        <p class="card-text">${client.email}</p>
                                        <a href="/admin/clients/${client.id}/edit"
                                        class="btn btn-primary btn-sm">Edit</a>
                                        <form action="/admin/clients/${client.id}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this client?')">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        `);
                    });
                }
            });
        });
    });
</script>
@endsection
