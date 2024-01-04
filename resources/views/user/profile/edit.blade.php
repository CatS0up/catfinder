@extends('user.layout')

@section('content')
    <div class="p-10 mt-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
        <div class="mauser.x-w-xl">
            @include('user.profile.partials.update-profile-information-form')
        </div>
    </div>

    <div class="p-10 mt-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
        <div class="max-w-xl">
            @include('user.profile.partials.update-password-form')
        </div>
    </div>

    <div class="p-10 mt-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
        <div class="max-w-xl">
            @include('user.profile.partials.delete-user-form')
        </div>
    </div>
@endsection
