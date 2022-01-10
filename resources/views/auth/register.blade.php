<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>

<body>
    @extends('layouts.master')

    @section('content')
    <div class="">
        <div class="add-user-form ">
            <div class="col-5 card mt-3 p-3 bg-dark">
                <x-auth-card>
                    <x-slot name="logo">

                    </x-slot>

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form class="bg-dark" method="POST" action="/addUserPost">
                        @csrf

                        <!-- Name -->
                        <div class="form-group">
                            <label for="name" class="text-light">Name</label>

                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                                required autofocus />
                        </div>

                        <!-- Email Address -->
                        <div class="form-group">
                            <label for="email">Email</label>

                            <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email')" required />
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <label for="password">Password</label>

                            <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                                autocomplete="new-password" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>

                            <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                name="password_confirmation" required />
                        </div>

                        <!-- Select Option Rol type -->
                        <div class="form-group">
                            <label for="role_id">Register as</label>
                            <select name="role_id" class="form-control" style="width: 100%;">
                                @foreach ($roles as $each)

                                @if ($each->name == 'user')
                                <option selected value="{{ $each->name }}">{{ $each->display_name }}</option>
                                @else
                                <option value="{{ $each->name }}">{{$each->display_name }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" value=0 name='status'>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="/dashboard/users" class="btn btn-secondary">Cansel</a>
                            <input type="submit" class="btn btn-info" value="Add-User">
                        </div>
                    </form>
                </x-auth-card>
            </div>
        </div>
    </div>

    @endsection
</body>

</html>