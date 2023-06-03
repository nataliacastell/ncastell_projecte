@extends('layout.master')

@section('content')
<link href="{{ asset('css/tailwind.css') }}" rel="stylesheet">

<div class="container">
    <div class="flex justify-center items-center h-screen">
        <div class="w-full max-w-sm">
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <h2 class="text-2xl mb-4">{{ __('Login') }}</h2>

                <form id="loginForm" novalidate>
                    @csrf

                    <div class="mb-4">
                        <label for="correo_electronico" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Correo Electronico') }}</label>
                        <input id="correo_electronico" type="email" class="form-control border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" name="correo_electronico" value="{{ old('correo_electronico') }}" required autocomplete="email" autofocus>

                        <span class="text-red-500 text-sm mt-1 error-message" id="correo_electronico-error"></span>
                    </div>

                    <div class="mb-6">
                        <label for="contrasena" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Constraseña') }}</label>
                        <input id="contrasena" type="password" class="form-control border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" name="contrasena" required autocomplete="current-password">

                        <span class="text-red-500 text-sm mt-1 error-message" id="contrasena-error"></span>
                    </div>

                    <div class="mb-6">
                        <div class="flex items-center">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="text-sm text-gray-700 ml-2" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="button" id="loginButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-blue-500 hover:text-blue-700" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#loginButton').click(function() {
            var correo_electronico = $('#correo_electronico').val();
            var contrasena = $('#contrasena').val();
            var remember = $('#remember').is(':checked');

            $.ajax({
                url: "{{ route('login') }}",
                method: "POST",
                data: {
                    correo_electronico: correo_electronico,
                    contrasena: contrasena,
                    remember: remember,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    window.location.href = "{{ route('lista') }}";
                },
                error: function(xhr) {
                    var errors = xhr.responseJSON.errors;
                    displayErrors(errors);
                }
            });
        });

        function displayErrors(errors) {
            $('.error-message').text('');

            $.each(errors, function(key, value) {
                $('#' + key + '-error').text(value[0]);
            });
        }
    });
</script>

<style>
    .form-control:focus {
        outline: none;
        border-color: #4F46E5;
        box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.3);
    }
    .invalid-feedback {
        display: block;
        color: #E53E3E;
        margin-top: 0.25rem;
    }
    .btn-primary {
        background-color: #4F46E5;
    }
    .btn-primary:hover {
        background-color: #4338CA;
    }
    .border {
        border-color: #CBD5E0;
    }
    .rounded {
        border-radius: 0.25rem;
    }
    .px-3 {
        padding-left: 0.75rem;
        padding-right: 0.75rem;
    }
    .py-2 {
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
    }
    .focus\:outline-none:focus {
        outline: none;
    }
    .focus\:ring-2:focus {
        box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.3);
    }
    .focus\:ring-blue-500:focus {
        --tw-ring-opacity: 1;
        --tw-ring-color: rgba(59, 130, 246, var(--tw-ring-opacity));
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.5);
    }
    .focus\:border-transparent:focus {
        border-color: transparent;
    }
</style>
@endsection
