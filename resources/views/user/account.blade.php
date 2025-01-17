@extends('layouts.app')

@section('content')
<div class="flex">
    <div class="w-1/4 bg-white p-4">
        @include('partials.sidebar-menu')
    </div>

    <div class="w-3/4 bg-gray-100 p-6 rounded-lg shadow-md">
        <h1 class="text-xl font-bold mb-4">My Account</h1>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if ($trainer)
            <div class="mb-6 p-4 rounded-lg">
                <h2 class="text-lg font-semibold">Your Trainer</h2>
                <p><strong>Name:</strong> {{ $trainer['name'] }}</p>
                <p><strong>Email:</strong> {{ $trainer['email'] }}</p>
                @if ($trainer['phone_number'])
                    <p><strong>Phone Number:</strong> {{ $trainer['phone_number'] }}</p>
                @else
                    <p class="text-gray-500">Your trainer's phone number is unavailable at the moment.</p>
                @endif
            </div>
        @else
            <div class="mb-6 p-4 bg-yellow-100 rounded-lg">
                <p>You don't have an assigned trainer.</p>
            </div>
        @endif

        <form action="{{ route('user.account.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="avatar" class="block font-medium">Avatar</label>
                @if ($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="mt-2 w-20 h-20 rounded-full">
                @endif
                <input type="file" name="avatar" id="avatar" class="block w-full mt-1">
            </div>

            <div class="mb-4">
                <label for="name" class="block font-medium">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                       class="block w-full mt-1 p-2 border rounded-lg">
                @if ($errors->has('name'))
                    <p class="text-red-500 text-sm mt-1">{{ $errors->first('name') }}</p>
                @endif
            </div>

            <div class="mb-4">
                <label for="email" class="block font-medium">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                       class="block w-full mt-1 p-2 border rounded-lg">
                @if ($errors->has('email'))
                    <p class="text-red-500 text-sm mt-1">{{ $errors->first('email') }}</p>
                @endif
            </div>

            <div class="mb-4">
                <label for="phone_number" class="block font-medium">Phone Number</label>
                <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $user->phone_number) }}"
                       class="block w-full mt-1 p-2 border rounded-lg">
                @if ($errors->has('phone_number'))
                    <p class="text-red-500 text-sm mt-1">{{ $errors->first('phone_number') }}</p>
                @endif
            </div>

            <div class="mb-4">
                <label for="password" class="block font-medium">New Password</label>
                <input type="password" name="password" id="password" class="block w-full mt-1 p-2 border rounded-lg">
                <small class="text-gray-500">Leave empty if you don't want to change the password.</small>
                @if ($errors->has('password'))
                    <p class="text-red-500 text-sm mt-1">{{ $errors->first('password') }}</p>
                @endif
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block font-medium">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="block w-full mt-1 p-2 border rounded-lg">
                @if ($errors->has('password_confirmation'))
                    <p class="text-red-500 text-sm mt-1">{{ $errors->first('password_confirmation') }}</p>
                @endif
            </div>

            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection


