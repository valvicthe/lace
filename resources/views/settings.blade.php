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
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>
    
    <?php 
        $error = request()->get('error');
    ?>

    @if($error)
    <div class="container mt-3">
        <div class="alert alert-danger" role="alert">
            {{ $error }}
        </div>
    </div>
    @endif
    
    <div class="container mt-4">
        <div class="row justify-content-center">
            
            <!-- Blurb Form -->
            <div class="col-md-6 mb-4">
                <form action="/changeblurb" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">Blurb</div>
                    <div class="card-body">
                        <textarea class="form-control mb-2" rows="4" name="blurb">{{ Auth::user()->blurb }}</textarea>
                        <button type="submit" class="btn btn-primary">Save Blurb</button>
                    </div>
                </div>
                </form>
            </div>

            <!-- Username Form -->
            <div class="col-md-6 mb-4">
                <form action="/changeusername" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">Change Username (250 Rainbux)</div>
                    <div class="card-body">
                        <input type="text" class="form-control mb-2" name="new_username" placeholder="New Username" required>
                        <button type="submit" class="btn btn-warning">Change Username</button>
                    </div>
                </div>
                </form>
            </div>

            <!-- Email & Password Form -->
            <div class="col-md-6 mb-4">
                <form action="/changeemail" method="POST">
                @csrf
                <div class="card mb-4">
                    <div class="card-header">Change Email</div>
                    <div class="card-body">
                        <input type="email" class="form-control mb-2" name="email" value="{{ Auth::user()->email }}" required>
                        <button type="submit" class="btn btn-primary">Save Email</button>
                    </div>
                </div>
                </form>

                <form action="/changepassword" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">Change Password</div>
                    <div class="card-body">
                        <input type="password" class="form-control mb-2" name="current_password" placeholder="Current Password" required>
                        <input type="password" class="form-control mb-2" name="new_password" placeholder="New Password" required>
                        <button type="submit" class="btn btn-danger">Update Password</button>
                    </div>
                </div>
                </form>

                <form action="/updatetheme" method="POST">
@csrf
<div class="card mb-4">
    <div class="card-header">Appearance</div>
    <div class="card-body">
        <label>Select Theme</label>
            <select name="theme" class="form-control mb-2">
            <option value="light" {{ Auth::user()->theme == 'light' ? 'selected' : '' }}>Light</option>
                        <option value="dark" {{ Auth::user()->theme == 'dark' ? 'selected' : '' }}>Dark</option>
                        </select>
                        <button type="submit" class="btn btn-primary">Save Theme</button>
                    </div>
                </div>
            </form>
            </div>

        </div>
    </div>
</x-app-layout>
