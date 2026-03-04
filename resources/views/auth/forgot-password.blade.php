@extends('layouts.app')

@section('title', 'Recuperar Contraseña')

@section('content')
<style>
    .reset-page {
        min-height: calc(100vh - 68px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
    }

    .reset-card {
        width: 100%;
        max-width: 460px;
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

    .reset-card::before {
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

    .reset-header {
        text-align: center;
        margin-bottom: 2.2rem;
    }

    .reset-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 56px; height: 56px;
        background: linear-gradient(135deg, var(--blue-400), var(--blue-600));
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(59,130,246,0.35);
        margin-bottom: 1.2rem;
    }

    .reset-icon svg {
        width: 26px; height: 26px;
        fill: none; stroke: white; stroke-width: 2;
    }

    .reset-title {
        font-family: 'DM Serif Display', serif;
        font-size: 1.8rem;
        color: var(--text-dark);
        margin-bottom: 0.4rem;
    }

    .reset-desc {
        font-size: 0.85rem;
        color: var(--text-mid);
        line-height: 1.5;
    }

    .form-group { margin-top: 1.6rem; }

    .form-label {
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.45rem;
        display: block;
    }

    .form-input {
        width: 100%;
        background: rgba(255,255,255,0.9);
        border: 1.5px solid var(--blue-pastel-mid);
        border-radius: 12px;
        padding: 0.75rem 1rem;
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

    .status-msg {
        margin-top: 1rem;
        font-size: 0.82rem;
        color: #166534;
        background: #dcfce7;
        border: 1px solid #bbf7d0;
        padding: 0.65rem 0.9rem;
        border-radius: 10px;
        font-weight: 500;
    }

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
        margin-top: 1.6rem;
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

    .back-link {
        text-align: center;
        margin-top: 1.6rem;
        padding-top: 1.4rem;
        border-top: 1px solid var(--blue-pastel-mid);
        font-size: 0.82rem;
        color: var(--text-mid);
    }

    .back-link a {
        font-weight: 700;
        color: var(--blue-600);
        text-decoration: none;
    }

    .back-link a:hover { text-decoration: underline; }
</style>

<div class="reset-page">
    <div class="reset-card">

        <div class="reset-header">
            <div class="reset-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M12 1v4"/>
                    <path d="M5.22 5.22l2.83 2.83"/>
                    <path d="M1 12h4"/>
                    <path d="M5.22 18.78l2.83-2.83"/>
                    <circle cx="12" cy="12" r="3"/>
                </svg>
            </div>
            <div class="reset-title">Recuperar Contraseña</div>
            <div class="reset-desc">
                Ingresa tu correo electrónico y te enviaremos un enlace
                para restablecer tu contraseña.
            </div>
        </div>

        @if (session('status'))
            <div class="status-msg">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" id="resetForm">
            @csrf

            <div class="form-group">
                <label class="form-label">Correo electrónico</label>
                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required autofocus
                       class="form-input @error('email') is-error @enderror">

                @error('email')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn-submit" id="resetBtn">
                Enviar enlace de recuperación
            </button>

            <div class="back-link">
                ¿Recordaste tu contraseña?
                <a href="{{ route('login') }}">Iniciar sesión</a>
            </div>

        </form>
    </div>
</div>

<script>
    document.getElementById('resetForm').addEventListener('submit', function() {
        const btn = document.getElementById('resetBtn');
        btn.disabled = true;
        btn.innerHTML = 'Enviando enlace...';
    });
</script>
@endsection