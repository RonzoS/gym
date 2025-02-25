<div class="relative">
    <input type="checkbox" id="menu-toggle" class="peer hidden">
    <label for="menu-toggle" class="p-2 bg-blue-500 text-white rounded-lg cursor-pointer md:hidden">
        ☰ Menu
    </label>

    <aside class="fixed inset-y-0 left-0 w-64 bg-white shadow-md p-4 transform -translate-x-full peer-checked:translate-x-0 transition-transform md:relative md:translate-x-0 md:block md:w-auto">
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
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </li>
        </ul>
    </aside>
</div>
