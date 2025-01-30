@extends('voyager::master')

@section('content')
    <div class="container">
        <h1>User measurement: {{ $user->name }}</h1>

        @if ($measurements->isEmpty())
            <p>No measurements for this user.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Measurement date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($measurements as $measurement)
                        <tr>
                            <td>{{ $measurement->created_at->format('Y-m-d H:i') }}
                            </td>
                            <td>
                                <a href="{{ route('voyager.measurements.show', $measurement->id) }}"
                                    class="btn btn-primary btn-sm">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-4">
                <nav aria-label="Pagination">
                    <ul class="pagination">
                        @if ($measurements->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">Previous</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link"
                                    href="{{ $measurements->previousPageUrl() }}"
                                    aria-label="Previous">
                                    Previous
                                </a>
                            </li>
                        @endif

                        @foreach ($measurements->getUrlRange(1, $measurements->lastPage()) as $page => $url)
                            <li
                                class="page-item {{ $page == $measurements->currentPage() ? 'active' : '' }}">
                                <a class="page-link"
                                    href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        @if ($measurements->hasMorePages())
                            <li class="page-item">
                                <a class="page-link"
                                    href="{{ $measurements->nextPageUrl() }}"
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

        @endif
        <div class="d-flex justify-content-between">
            <a href="{{ route('voyager.manage-users.manage', $user->id) }}"
                class="btn btn-secondary">Return</a>
        </div>
    </div>
@endsection
