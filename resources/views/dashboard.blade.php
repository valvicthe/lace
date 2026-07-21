<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name'); }} - Home</title>
        <style>
            /* Greeting Styles */
            .greeting-title {
                font-size: 2.5rem; /* Forces it to be big */
                font-weight: 800; /* Forces it to be bold */
                color: #111827;
                margin-bottom: 0.5rem;
                line-height: 1.2;
            }
            .greeting-subtitle {
                font-size: 1.125rem;
                color: #6b7280;
                margin-bottom: 2rem;
            }

            /* Quick Links Styles */
            .quick-links-container {
                display: flex;
                flex-wrap: wrap;
                gap: 16px;
                margin-top: 24px;
            }
            .quick-link-btn {
                width: 120px;
                height: 120px;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                background-color: #f8fafc;
                border: 1px solid #e2e8f0;
                border-radius: 16px;
                color: #475569;
                text-decoration: none;
                transition: all 0.3s ease;
            }
            .quick-link-btn:hover {
                background-color: #ffffff;
                border-color: #3b82f6; /* Blue border */
                color: #3b82f6; /* Blue text and icon */
                transform: translateY(-2px);
                box-shadow: 0 0 15px rgba(59, 130, 246, 0.5); /* Blue glow effect */
            }
            .quick-link-icon {
                width: 36px;
                height: 36px;
                margin-bottom: 12px;
            }
            .quick-link-text {
                font-weight: 600;
                font-size: 15px;
            }
        </style>
    </head>
</html>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <!-- Greeting -->
                    <h1 class="greeting-title">haii {{ Auth::user()->name }}</h1>
                    <p class="greeting-subtitle">Welcome to raiin [V2}!</p>

                    <!-- Square Quick Links -->
                    <div class="quick-links-container">
                        
                        <!-- Shop Link -->
                        <a href="{{ route('shop') }}" class="quick-link-btn">
                            <svg class="quick-link-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            <span class="quick-link-text">Shop</span>
                        </a>

                        <!-- Games Link -->
                        <a href="{{ route('games') }}" class="quick-link-btn">
                            <svg class="quick-link-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="quick-link-text">Games</span>
                        </a>

                        <!-- Settings Link -->
                        <a href="{{ route('settings') }}" class="quick-link-btn">
                            <svg class="quick-link-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="quick-link-text">Settings</span>
                        </a>

                        <a href="{{ route('rainbux') }}" class="quick-link-btn">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/0/09/Robux_2019_Logo_Black.svg" width="60" height="60" alt="Rainbux">
                            <span class="quick-link-text">Rainbux</span>
                        </a>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Recent Development</h3>
                @if(isset($commits) && is_array($commits))
                    <ul class="space-y-4">
                        @foreach(array_slice($commits, 0, 5) as $commit)
                            <li class="border-b border-gray-100 dark:border-gray-700 pb-3 last:border-0 last:pb-0">
                                <a href="{{ $commit['html_url'] }}" target="_blank" class="block group">
                                    <span class="text-blue-600 dark:text-blue-400 font-medium group-hover:underline">
                                        {{ Str::limit($commit['commit']['message'], 60) }}
                                    </span>
                                    <div class="flex items-center text-xs text-gray-500 dark:text-gray-400 mt-1">
                                        <span>{{ $commit['commit']['author']['name'] }}</span>
                                        <span class="mx-2">•</span>
                                        <span>{{ \Carbon\Carbon::parse($commit['commit']['author']['date'])->diffForHumans() }}</span>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 dark:text-gray-400">Could not load recent commits.</p>
                @endif
            </div>
</x-app-layout>
