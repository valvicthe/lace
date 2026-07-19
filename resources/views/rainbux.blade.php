<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rainbux') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <div class="row justify-content-center">
            
            <!-- Balance Card -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">Your Balance</div>
                    <div class="card-body text-center">
                        <h1 class="display-4">{{ number_format(Auth::user()->rainbux) }}</h1>
                        <p class="lead">Rainbux</p>
                    </div>
                </div>
            </div>

            <!-- Ways to get more -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">How to Earn Rainbux</div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong>Daily Stipend:</strong> You receive a free <strong>150 Rainbux</strong> stipend!
                            </li>
                            <li class="list-group-item">
                                <strong>Sell Items:</strong> Create and sell clothing or accessories in the shop.
                            </li>
                            <li class="list-group-item">
                                <strong>Events:</strong> Participate in official platform events and competitions.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
