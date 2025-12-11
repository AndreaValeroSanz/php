@extends('layouts.app')

@section('content')
<style>
    .auth-page-wrapper {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 1rem;
    }

    .auth-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.6);
        border-radius: 1.5rem;
        box-shadow: 0 20px 50px rgba(15, 23, 42, 0.12);
        overflow: hidden;
        width: 100%;
        max-width: 480px;
        transition: transform 0.3s ease;
    }

    .auth-header {
        background: linear-gradient(135deg, #0f9f9a, #0f766e);
        padding: 2.5rem 2rem 2rem;
        text-align: center;
        color: white;
        position: relative;
    }

    .auth-header::after {
        content: "";
        position: absolute;
        bottom: -20px;
        left: 0;
        right: 0;
        height: 40px;
        background: white;
        border-radius: 50% 50% 0 0 / 100% 100% 0 0;
    }

    .auth-icon {
        width: 60px;
        height: 60px;
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        color: #fff;
    }
    
    .auth-icon svg {
        width: 30px;
        height: 30px;
    }

    .auth-body {
        padding: 2rem 2.5rem 2.5rem;
    }

    .form-control {
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 0.75rem;
        padding: 0.8rem 1rem;
        font-size: 0.95rem;
        transition: all 0.2s;
    }

    .form-control:focus {
        background-color: #fff;
        border-color: #0f9f9a;
        box-shadow: 0 0 0 4px rgba(15, 159, 154, 0.1);
    }

    .form-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #475569;
        margin-bottom: 0.5rem;
    }

    .btn-auth-primary {
        background: #0f766e;
        border: none;
        color: #fff;
        font-weight: 600;
        border-radius: 999px;
        padding: 0.8rem;
        width: 100%;
        font-size: 1rem;
        box-shadow: 0 4px 12px rgba(15, 118, 110, 0.3);
        transition: all 0.2s ease;
    }

    .btn-auth-primary:hover {
        background: #115e59;
        transform: translateY(-2px);
        color: #fff;
        box-shadow: 0 6px 15px rgba(15, 118, 110, 0.4);
    }

    .auth-footer-link {
        color: #0f766e;
        font-weight: 500;
        text-decoration: none;
        font-size: 0.9rem;
    }
    
    .auth-footer-link:hover {
        color: #facc6b;
        text-decoration: underline;
    }
</style>

<div class="auth-page-wrapper">
    <div class="auth-card">
        <div class="auth-header">
            <div class="auth-icon">
                {{-- Heroicons: Lock Closed --}}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0V10.5m-1.5 0h12a2.25 2.25 0 012.25 2.25v7.5a2.25 2.25 0 01-2.25 2.25h-12a2.25 2.25 0 01-2.25-2.25v-7.5a2.25 2.25 0 012.25-2.25z" />
                </svg>
            </div>
            <h4 class="fw-bold m-0">Bienvenido de nuevo</h4>
            <p class="small opacity-75 mb-0">Accede a tu panel de gestión</p>
        </div>

        <div class="auth-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                @if ($errors->has('auth_error') || $errors->has('email'))
                    <div class="alert alert-danger rounded-3 border-0 shadow-sm mb-4">
                        <small class="d-block text-center">
                            {{ $errors->first('auth_error') ?: $errors->first('email') }}
                        </small>
                    </div>
                @endif

                <div class="mb-4">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" value="{{ old('email') }}" 
                           placeholder="nombre@ejemplo.com" required autofocus>
                </div>

                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <label for="password" class="form-label mb-0">Contraseña</label>
                        @if (Route::has('password.request'))
                            <a class="auth-footer-link small" href="{{ route('password.request') }}">
                                ¿Olvidaste tu contraseña?
                            </a>
                        @endif
                    </div>
                    <input type="password" class="form-control mt-2 @error('password') is-invalid @enderror" 
                           id="password" name="password" placeholder="••••••••" required>
                </div>

                <div class="d-grid mb-4">
                    <button type="submit" class="btn btn-auth-primary">
                        Iniciar Sesión
                    </button>
                </div>

                <div class="text-center">
                    <span class="text-muted small">¿No tienes cuenta?</span>
                    <a href="{{ route('register') }}" class="auth-footer-link ms-1">Regístrate aquí</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection