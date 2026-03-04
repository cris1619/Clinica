@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
<style>
    /* ── Login page ── */
    .login-page {
        min-height: calc(100vh - 68px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
    }

    .login-card {
        width: 100%;
        max-width: 440px;
        background: rgba(255, 255, 255, 0.78);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid var(--blue-pastel-mid);
        border-radius: 22px;
        padding: 2.8rem 2.5rem;
        box-shadow: var(--shadow-blue), 0 0 0 1px rgba(255,255,255,0.6) inset;
        animation: cardIn 0.5s cubic-bezier(0.22, 1, 0.36, 1) both;
        position: relative;
        overflow: hidden;
    }

    .login-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--blue-400), var(--blue-600), var(--blue-400));
    }

    @keyframes cardIn {
        from { opacity: 0; transform: translateY(24px) scale(0.98); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }

    /* Header */
    .login-header { text-align: center; margin-bottom: 2.2rem; }

    .login-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 56px; height: 56px;
        background: linear-gradient(135deg, var(--blue-400), var(--blue-600));
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(59,130,246,0.35);
        margin-bottom: 1.2rem;
    }

    .login-icon svg {
        width: 26px; height: 26px;
        fill: none; stroke: white; stroke-width: 2;
    }

    .login-title {
        font-family: 'DM Serif Display', serif;
        font-size: 1.8rem;
        color: var(--text-dark);
        margin-bottom: 0.4rem;
    }

    .login-desc {
        font-size: 0.85rem;
        color: var(--text-mid);
    }

    /* Inputs */
    .form-group { margin-bottom: 1.3rem; }

    .form-label {
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.45rem;
        display: block;
    }

    .input-wrapper { position: relative; }

    .input-icon {
        position: absolute;
        left: 0.9rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--blue-400);
        pointer-events: none;
    }

    .form-input {
        width: 100%;
        background: rgba(255,255,255,0.9);
        border: 1.5px solid var(--blue-pastel-mid);
        border-radius: 12px;
        padding: 0.75rem 1rem 0.75rem 2.7rem;
        font-size: 0.88rem;
        color: var(--text-dark);
        transition: all 0.2s ease;
        outline: none;
    }

    .form-input:focus {
        border-color: var(--blue-500);
        box-shadow: 0 0 0 3px rgba(59,130,246,0.18);
        background: #fff;
    }

    .form-input.is-error {
        border-color: #f87171;
        background: #fff5f5;
    }

    .form-error {
        font-size: 0.75rem;
        color: #ef4444;
        margin-top: 0.4rem;
        font-weight: 500;
    }

    /* Footer row */
    .form-footer-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 1.4rem 0 1.8rem;
    }

    .remember-label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.82rem;
        color: var(--text-mid);
        cursor: pointer;
    }

    .remember-label input {
        accent-color: var(--blue-500);
    }

    .forgot-link {
        font-size: 0.82rem;
        font-weight: 600;
        color: var(--blue-500);
        text-decoration: none;
    }

    .forgot-link:hover {
        text-decoration: underline;
        color: var(--blue-600);
    }

    /* Button */
    .btn-submit {
        width: 100%;
        padding: 0.85rem;
        background: linear-gradient(135deg, var(--blue-400), var(--blue-600));
        border: none;
        border-radius: 12px;
        font-size: 0.9rem;
        font-weight: 700;
        color: white;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 6px 18px rgba(59,130,246,0.35);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .btn-submit:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 22px rgba(59,130,246,0.45);
    }

    .btn-submit:disabled {
        opacity: 0.7;
        cursor: not-allowed;
        transform: none;
    }

    .register-prompt {
        text-align: center;
        margin-top: 1.6rem;
        padding-top: 1.4rem;
        border-top: 1px solid var(--blue-pastel-mid);
        font-size: 0.82rem;
        color: var(--text-mid);
    }

    .register-prompt a {
        font-weight: 700;
        color: var(--blue-600);
        text-decoration: none;
    }

    .register-prompt a:hover { text-decoration: underline; }
</style>

<div class="login-page">
    <div class="login-card">

        <div class="login-header">
            <div class="login-icon">
                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="7" r="4"/>
                    <path d="M5.5 21a6.5 6.5 0 0 1 13 0"/>
                </svg>
            </div>
            <div class="login-title">Acceso al Sistema</div>
            <div class="login-desc">Ingresa tus credenciales para continuar</div>
        </div>

        <form method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">Correo electrónico</label>
                <div class="input-wrapper">
                    <span class="input-icon">@</span>
                    <input id="email" type="email" name="email"
                        value="{{ old('email') }}"
                        required autofocus
                        class="form-input @error('email') is-error @enderror">
                </div>
                @error('email')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Contraseña</label>
                <div class="input-wrapper">
                    <span class="input-icon">🔒</span>
                    <input id="password" type="password" name="password"
                        required
                        class="form-input @error('password') is-error @enderror">
                </div>
                @error('password')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-footer-row">
                <label class="remember-label">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    Recordarme
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-link">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>

            <button type="submit" class="btn-submit" id="submitBtn">
                Ingresar
            </button>

            <div class="register-prompt">
                ¿No tienes cuenta?
                <a href="{{ route('register') }}">Crear una ahora</a>
            </div>

        </form>
    </div>
</div>

<script>
    document.getElementById('loginForm').addEventListener('submit', function() {
        const btn = document.getElementById('submitBtn');
        btn.disabled = true;
        btn.innerHTML = 'Ingresando...';
    });
</script>
@endsection