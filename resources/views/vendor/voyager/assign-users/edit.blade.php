@extends('voyager::master')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Edit trainer: {{ $trainer->name }}</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-5">
        <div class="card-header">
            <h3 class="custom-margin">Assigned users</h3>
        </div>
        <div class="card-body">
            @if($assignedUsers->isEmpty())
                <p>No assigned users.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($assignedUsers as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <form method="POST"
                                          action="{{ route('voyager.assign-users.detach', [$trainer->id, $user->id]) }}"
                                          onsubmit="return confirm('Are you sure you want to delete this user?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="custom-margin">Add users</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('voyager.assign-users.update', $trainer->id) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="users">Select users:</label>
                    <select name="user_ids[]" id="users" class="form-control select2" multiple>
                        @foreach($availableUsers as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Add users</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    .custom-margin {
        margin-left: 15px;
    }
</style>
@endsection


