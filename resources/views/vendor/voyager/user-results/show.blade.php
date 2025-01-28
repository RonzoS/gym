@extends('voyager::master')

@section('content')
<div class="container">
    <h1>Results for exercise: {{ $exercise->name }}</h1>

    <!-- Szczegóły ćwiczenia -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Exercise Details</h5>
            <p><strong>Description:</strong></br> {!! nl2br(e($exercise->description)) !!}</p>
            <p><strong>Muscles:</strong>
                @foreach($exercise->muscles as $muscle)
                    {{ $muscle->name }}{{ !$loop->last ? ', ' : '' }}
                @endforeach
            </p>
            <p><strong>Tools:</strong>
                @foreach($exercise->tools as $tool)
                    {{ $tool->name }}{{ !$loop->last ? ', ' : '' }}
                @endforeach
            </p>
        </div>
    </div>

    <!-- Wyniki ćwiczenia -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">User Results</h5>
            @if($exerciseResults->isEmpty())
                <p>No results found for this exercise.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'created_at', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                    Date Performed
                                    @if(request('sort') === 'created_at')
                                        <span>{{ request('direction') === 'asc' ? '▲' : '▼' }}</span>
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'performed_reps', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                    Reps
                                    @if(request('sort') === 'performed_reps')
                                        <span>{{ request('direction') === 'asc' ? '▲' : '▼' }}</span>
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'performed_weight', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                    Weight (kg)
                                    @if(request('sort') === 'performed_weight')
                                        <span>{{ request('direction') === 'asc' ? '▲' : '▼' }}</span>
                                    @endif
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($exerciseResults as $result)
                        <tr>
                            <td>{{ $result->created_at ? $result->created_at->format('Y-m-d H:i') : 'N/A' }}</td>
                            <td>{{ $result->performed_reps ?? 'N/A' }}</td>
                            <td>{{ $result->performed_weight ? number_format($result->performed_weight, 2) : 'N/A' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-center mt-4">
                    <nav aria-label="Pagination">
                        <ul class="pagination">
                            @if ($exerciseResults->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">Previous</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $exerciseResults->previousPageUrl() }}" aria-label="Previous">
                                        Previous
                                    </a>
                                </li>
                            @endif

                            @foreach ($exerciseResults->getUrlRange(1, $exerciseResults->lastPage()) as $page => $url)
                                <li class="page-item {{ $page == $exerciseResults->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach

                            @if ($exerciseResults->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $exerciseResults->nextPageUrl() }}" aria-label="Next">
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
</div>
@endsection
