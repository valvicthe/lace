<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name'); }} - Settings</title>
    </head>
</html>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>

    <!-- Tab Container -->
    <div class="py-12" x-data="{ activeTab: 'profile' }">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Error Message --}}
            @if(request()->has('error'))
                <div class="mb-6 p-4 bg-red-100 dark:bg-red-900/50 border border-red-400 text-red-700 dark:text-red-300 rounded-lg">
                    {{ request()->get('error') }}
                </div>
            @endif

            <!-- Tab Navigation -->
            <div class="flex border-b border-gray-200 dark:border-gray-700 mb-6">
                <button @click="activeTab = 'profile'" :class="activeTab === 'profile' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500'" class="py-2 px-6 border-b-2 font-medium transition">Profile</button>
                <button @click="activeTab = 'security'" :class="activeTab === 'security' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500'" class="py-2 px-6 border-b-2 font-medium transition">Security</button>
                <button @click="activeTab = 'appearance'" :class="activeTab === 'appearance' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500'" class="py-2 px-6 border-b-2 font-medium transition">Appearance</button>
            </div>

            <!-- Tab Content -->
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                
                <!-- Profile Tab -->
                <div x-show="activeTab === 'profile'" x-cloak>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Edit Profile</h3>
                    <form action="/changeblurb" method="POST" class="mb-8">
                        @csrf
                        <label class="block text-sm text-gray-600 dark:text-gray-400">Blurb</label>
                        <textarea name="blurb" rows="4" class="w-full mt-1 mb-4 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white">{{ Auth::user()->blurb }}</textarea>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md transition">Save Blurb</button>
                    </form>

                    <form action="/changeusername" method="POST">
                        @csrf
                        <label class="block text-sm text-gray-600 dark:text-gray-400">Username (250 Rainbux)</label>
                        <input type="text" name="new_username" placeholder="New Username" required class="w-full mt-1 mb-4 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white">
                        <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-md transition">Change Username</button>
                    </form>
                </div>

                <!-- Security Tab -->
                <div x-show="activeTab === 'security'" x-cloak>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Account Security</h3>
                    <form action="/changeemail" method="POST" class="mb-8 border-b border-gray-200 dark:border-gray-700 pb-8">
                        @csrf
                        <label class="block text-sm text-gray-600 dark:text-gray-400">Email Address</label>
                        <input type="email" name="email" value="{{ Auth::user()->email }}" required class="w-full mt-1 mb-2 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md transition">Save Email</button>
                    </form>

                    <form action="/changepassword" method="POST">
                        @csrf
                        <label class="block text-sm text-gray-600 dark:text-gray-400">Change Password</label>
                        <input type="password" name="current_password" placeholder="Current Password" required class="w-full mt-1 mb-2 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white">
                        <input type="password" name="new_password" placeholder="New Password" required class="w-full mb-2 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white">
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md transition">Update Password</button>
                    </form>
                </div>

                <!-- Appearance Tab -->
                <div x-show="activeTab === 'appearance'" x-cloak>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Appearance Settings</h3>
                    <form action="/updatetheme" method="POST">
                        @csrf
                        <label class="block text-sm text-gray-600 dark:text-gray-400">Select Theme</label>
                        <select name="theme" class="w-full mt-1 mb-4 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white">
                            <option value="light" {{ Auth::user()->theme == 'light' ? 'selected' : '' }}>Light</option>
                            <option value="dark" {{ Auth::user()->theme == 'dark' ? 'selected' : '' }}>Dark (Beta)</option>
                        </select>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md transition">Save Theme</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
