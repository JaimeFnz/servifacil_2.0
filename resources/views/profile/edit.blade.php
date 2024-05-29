@extends('adminlte::page')

@section('title', 'Servifacil | Profile')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-12 mt-3">
                <div class="mb-4 p-4 bg-white dark:bg-gray-800 shadow rounded">
                    <div class="max-w-xl mx-auto">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="mb-4 p-4 bg-white dark:bg-gray-800 shadow rounded">
                    <div class="max-w-xl mx-auto">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="mb-4 p-4 bg-white dark:bg-gray-800 shadow rounded">
                    <div class="max-w-xl mx-auto">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
