<header class="bg-gray-800 text-white">
    <div class="container mx-auto flex items-center justify-between py-4 px-6">
        <a href="/" class="text-2xl font-bold flex items-center space-x-2">
            <img src="{{ asset('images/logo.png') }}" alt="MyGym" class="h-8">
            <span class="text-white">MyGym</span>
        </a>

        <div class="flex items-center space-x-4">
            @auth
                @if(auth()->user()->hasRole(['admin', 'trainer']))
                    <a href="{{ route('voyager.dashboard') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded">Dashboard</a>
                @endif
                <a href="{{ route('user.account') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Konto</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Wyloguj</button>
                </form>
                <a href="{{ route('user.account') }}">
                    <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar" class="w-10 h-10 rounded-full">
                </a>
            @else
                <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Zaloguj się</a>
                <a href="{{ route('register') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Zarejestruj się</a>
            @endauth
        </div>
    </div>
</header>
