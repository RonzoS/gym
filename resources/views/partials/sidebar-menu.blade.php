<aside class="bg-white rounded-lg shadow-md p-4">
    <ul class="space-y-2">
        <li>
            <a href="{{ route('user.account') }}"
               class="block py-2 px-4 rounded-lg font-medium @if (Request::is('user/account*')) bg-blue-500 text-white @else hover:bg-gray-100 @endif">
                My Account
            </a>
        </li>
        <li>
            <a href="{{ route('user.workouts.index') }}"
               class="block py-2 px-4 rounded-lg font-medium @if (Request::is('user/workouts*')) bg-blue-500 text-white @else hover:bg-gray-100 @endif">
                Workouts
            </a>
        </li>
        <li>
            <a href="{{ route('user.results.index') }}"
               class="block py-2 px-4 rounded-lg font-medium @if (Request::is('user/results*')) bg-blue-500 text-white @else hover:bg-gray-100 @endif">
                Results
            </a>
        </li>
        <li>
            <a href="{{ route('user.measurements.index') }}"
               class="block py-2 px-4 rounded-lg font-medium @if (Request::is('user/measurements*')) bg-blue-500 text-white @else hover:bg-gray-100 @endif">
                Measurements
            </a>
        </li>
        <li>
            <a href="{{ route('user.dailycalorieintakes') }}"
               class="block py-2 px-4 rounded-lg font-medium @if (Request::is('user/dailycalorieintakes*')) bg-blue-500 text-white @else hover:bg-gray-100 @endif">
                Daily Calorie Intakes
            </a>
        </li>
        <li>
            <a href="{{ route('logout') }}"
               class="block py-2 px-4 rounded-lg font-medium text-red-600 hover:bg-gray-100"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Wyloguj się
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</aside>
