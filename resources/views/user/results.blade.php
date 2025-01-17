@extends('layouts.app')

@section('content')
<div class="flex">
    {{-- Sidebar Menu --}}
    @include('partials.sidebar-menu')

    {{-- Main Content --}}
    <div class="w-3/4 bg-gray-100 p-6 rounded-lg shadow-md">
        <h1 class="text-xl font-bold mb-4">Results</h1>
        <p>Informacje o wynikach.</p>
        {{-- Dodaj treść dla My Account --}}
    </div>
</div>
@endsection
