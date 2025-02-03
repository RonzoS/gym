@extends('voyager::master')

@section('content')
    <div class="container">
        <h1>User list</h1>

        <form method="GET" action="{{ route('voyager.manage-users.index') }}">
            <div class="form-group">
                <input type="text" name="search" class="form-control"
                    placeholder="Search for user..." value="{{ request('search') }}">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>Incoming workouts</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{$user->user_workouts_count}}</td>
                        <td>
                            <a href="{{ route('voyager.manage-users.manage', $user->id) }}"
                                class="btn btn-primary">Manage</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-4">
            <nav aria-label="Pagination">
                <ul class="pagination">
                    @if ($users->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link">Previous</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link"
                                href="{{ $users->previousPageUrl() }}"
                                aria-label="Previous">
                                Previous
                            </a>
                        </li>
                    @endif

                    @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                        <li
                            class="page-item {{ $page == $users->currentPage() ? 'active' : '' }}">
                            <a class="page-link"
                                href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach

                    @if ($users->hasMorePages())
                        <li class="page-item">
                            <a class="page-link"
                                href="{{ $users->nextPageUrl() }}"
                                aria-label="Next">
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
    </div>
@endsection
