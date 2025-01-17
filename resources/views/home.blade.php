@extends('layouts.app')

@section('title', 'Strona Główna - MyGym')

@section('content')
<div class="bg-gray-800 text-white py-20">
    <div class="container mx-auto text-center">
        <h1 class="text-4xl font-bold mb-4">Witaj w MyGym</h1>
        <p class="text-lg mb-6">Twoje zdrowie i forma na pierwszym miejscu. Dołącz do nas i odkryj, co możemy zaoferować!</p>
    </div>
</div>

<div class="py-16 bg-gray-50">
    <div class="container mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
        <div class="ml-4">
            <h2 class="text-3xl font-bold mb-4 text-gray-800">Wirtualny Trener</h2>
            <p class="text-lg text-gray-700 mb-6">
                Skorzystaj z innowacyjnego rozwiązania, jakim jest subskrypcja na wirtualnego trenera.</br></br> Dzięki tej opcji otrzymasz:
            </p>
            <ul class="text-gray-700 mb-6 space-y-2">
                <li>✔ Spersonalizowany plan treningowy dostosowany do Twoich potrzeb.</li>
                <li>✔ Możliwość konsultacji z naszymi doświadczonymi trenerami.</li>
                <li>✔ Dostęp do wirtualnych treningów, które możesz wykonać w domu lub na siłowni.</li>
                <li>✔ Regularne porady i wsparcie w zakresie diety oraz suplementacji.</li>
            </ul>
            <p class="text-lg text-gray-700 mb-6">
                Swojego wirtualnego trenera możesz spotkać na naszej siłowni!
            </p>
             <a href="/wirtualny-trener" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Dowiedz się więcej</a>
        </div>
        <div class="flex justify-center">
            <img src="{{ asset('images/virtual-trainer.png') }}" alt="Wirtualny Trener" class="rounded shadow-md max-w-full h-auto">
        </div>
    </div>
</div>

<div class="py-16 bg-white">
    <div class="container mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-green-600 text-white p-6 rounded shadow-md">
            <h3 class="text-2xl font-bold mb-4">Ceny Karnetów</h3>
            <ul>
                <li class="flex justify-between border-b border-green-400 py-2">
                    <span>Pojedyncze wejście</span>
                    <span>35 zł</span>
                </li>
                <li class="flex justify-between border-b border-green-400 py-2">
                    <span>4 wejścia</span>
                    <span>75 zł</span>
                </li>
                <li class="flex justify-between border-b border-green-400 py-2">
                    <span>8 wejść</span>
                    <span>120 zł</span>
                </li>
                <li class="flex justify-between border-b border-green-400 py-2">
                    <span>12 wejść</span>
                    <span>140 zł</span>
                </li>
                <li class="flex justify-between border-b border-green-400 py-2">
                    <span>Open</span>
                    <span>170 zł</span>
                </li>
                <li class="flex justify-between border-b border-green-400 py-2">
                    <span>Poranny Open</span>
                    <span>130 zł</span>
                </li>
                <li class="flex justify-between py-2">
                    <span>Open 3-miesięczny</span>
                    <span>400 zł</span>
                </li>
            </ul>
        </div>

        <div>
            <div class="bg-gray-800 text-white p-6 rounded shadow-md mb-6">
                <h3 class="text-2xl font-bold mb-4">Kontakt</h3>
                <p>Katowice, 44-000</p>
                <p>ul. Testowa 123</p>
                <p>123 123 123</p>
                <p>biuro.mygym@gmail.com</p>
            </div>
            <div class="bg-gray-800 text-white p-6 rounded shadow-md">
                <h3 class="text-2xl font-bold mb-4">Godziny Otwarcia</h3>
                <ul>
                    <li class="flex justify-between border-b border-gray-600 py-2">
                        <span>Poniedziałek - Piątek</span>
                        <span>06:00 - 22:00</span>
                    </li>
                    <li class="flex justify-between border-b border-gray-600 py-2">
                        <span>Sobota</span>
                        <span>07:00 - 17:00</span>
                    </li>
                    <li class="flex justify-between py-2">
                        <span>Niedziela</span>
                        <span>08:00 - 15:00</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
