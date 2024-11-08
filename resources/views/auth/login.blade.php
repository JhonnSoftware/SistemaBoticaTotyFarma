<x-guest-layout>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <!-- Logo de la empresa -->
                    <div class="text-center">
                        <img src="{{ asset('imagenes/logo.jpeg') }}" alt="Boticas D'Toty Farma" class="img-fluid mb-4" style="max-height: 150px;">
                    </div>

                    <!-- Título de inicio de sesión -->
                    <h2 class="text-center mb-4">Iniciar Sesión</h2>

                    <!-- Mostrar mensajes de sesión -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Formulario de login -->
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address -->
                        <div class="mb-3">
                            <x-input-label for="email" :value="__('Correo Electrónico')" class="form-label" />
                            <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="text-danger small mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <x-input-label for="password" :value="__('Contraseña')" class="form-label" />
                            <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
                            <x-input-error :messages="$errors->get('password')" class="text-danger small mt-2" />
                        </div>

                        <!-- Remember Me -->
                        <div class="form-check mb-3">
                            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                            <label for="remember_me" class="form-check-label">{{ __('Recuérdame') }}</label>
                        </div>

                        <!-- Forgot Password and Submit Button -->
                        <div class="d-flex justify-content-between align-items-center">
                            @if (Route::has('password.request'))
                                <a class="text-decoration-none" href="{{ route('password.request') }}">
                                    {{ __('¿Olvidaste tu contraseña?') }}
                                </a>
                            @endif

                            <x-primary-button class="btn btn-primary">
                                {{ __('Iniciar Sesión') }}
                            </x-primary-button>
                        </div>
                    </form>

                    <!-- Opciones de inicio de sesión con redes sociales -->
                    <div class="text-center mt-3">
                        <p>...o iniciar sesión usando</p>
                        <a href="{{ route('auth.google') }}" class="btn btn-outline-primary w-100 mb-2">
                            <img src="{{ asset('imagenes/google.png')}}" alt="Google Logo" style="height: 25px; margin-right: 8px;">
                            Continuar con Google
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
