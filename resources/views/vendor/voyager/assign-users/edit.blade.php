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
                <form method="GET" action="{{ route('voyager.assign-users.edit', $trainer->id) }}">
                    <div class="form-group">
                        <input type="text" name="search" class="form-control" placeholder="Search assigned users..." value="{{ request('search') }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
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

                <div class="d-flex justify-content-center mt-4">
                    <nav aria-label="Pagination">
                        <ul class="pagination">
                            @if ($assignedUsers->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">Previous</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $assignedUsers->previousPageUrl() }}" aria-label="Previous">
                                        Previous
                                    </a>
                                </li>
                            @endif

                            @foreach ($assignedUsers->getUrlRange(1, $assignedUsers->lastPage()) as $page => $url)
                                <li class="page-item {{ $page == $assignedUsers->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach

                            @if ($assignedUsers->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $assignedUsers->nextPageUrl() }}" aria-label="Next">
                                        Next
                                    </a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link">Next</span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
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


