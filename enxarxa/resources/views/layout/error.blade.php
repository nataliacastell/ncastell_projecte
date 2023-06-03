
@extends('layout.master')

@section('content')
    <div class="container mx-auto py-16">
        <div class="max-w-md mx-auto bg-white rounded-lg shadow-lg">
            <div class="px-6 py-4">
                <h1 class="text-4xl font-bold text-gray-800">Oops! Error 404</h1>
                <p class="mt-2 text-lg text-gray-600">Lo sentimos, la página que estás buscando no existe.</p>
                @if (session('debugInfo'))
                <pre class="mt-4">{{ session('debugInfo') }}</pre>
            @endif
            @if (session('usuario'))
                <pre class="mt-4">{{ session('usuario') }}</pre>
            @endif
            </div>
        </div>
    </div>
@endsection


