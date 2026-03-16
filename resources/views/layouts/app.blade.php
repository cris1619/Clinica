<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Clinica')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=DM+Serif+Display&display=swap');

        :root {
            --blue-pastel-bg:   #e8f0fe;
            --blue-pastel-mid:  #c7d9fd;
            --blue-pastel-soft: #f0f5ff;
            --blue-300: #93c5fd;
            --blue-400: #60a5fa;
            --blue-500: #3b82f6;
            --blue-600: #2563eb;
            --text-dark:   #1e3a5f;
            --text-mid:    #4a6fa5;
            --shadow-blue: 0 4px 24px rgba(59, 130, 246, 0.12);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--blue-pastel-soft);
            background-image:
                radial-gradient(ellipse at 10% 0%, #dbeafe 0%, transparent 55%),
                radial-gradient(ellipse at 90% 100%, #bfdbfe 0%, transparent 50%);
            min-height: 100vh;
            color: var(--text-dark);
        }

        /* Decorative blobs */
        body::before {
            content: '';
            position: fixed;
            top: -80px; right: -80px;
            width: 340px; height: 340px;
            background: radial-gradient(circle, #bfdbfe 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none; z-index: 0;
        }
        body::after {
            content: '';
            position: fixed;
            bottom: -60px; left: -60px;
            width: 280px; height: 280px;
            background: radial-gradient(circle, #dbeafe 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none; z-index: 0;
        }

        /* ── Navbar ── */
        nav {
            background: rgba(255, 255, 255, 0.72);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--blue-pastel-mid);
            position: sticky; top: 0; z-index: 100;
            box-shadow: var(--shadow-blue);
        }

        .nav-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            height: 68px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Logo */
        .nav-logo {
            display: flex; align-items: center; gap: 0.6rem;
            text-decoration: none;
        }
        .nav-logo-icon {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--blue-400), var(--blue-600));
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.35);
        }
        .nav-logo-icon svg { width: 18px; height: 18px; fill: none; stroke: white; stroke-width: 2; }
        .nav-logo-text {
            font-family: 'DM Serif Display', serif;
            font-size: 1.25rem;
            color: var(--text-dark);
        }

        /* Nav actions */
        .nav-actions { display: flex; align-items: center; gap: 1rem; }

        .nav-username {
            font-size: 0.875rem; font-weight: 500;
            color: var(--text-mid);
            background: var(--blue-pastel-bg);
            padding: 0.35rem 0.85rem;
            border-radius: 999px;
            border: 1px solid var(--blue-pastel-mid);
        }

        .btn-logout {
            background: linear-gradient(135deg, #60a5fa, #3b82f6);
            color: white; border: none;
            padding: 0.45rem 1.1rem; border-radius: 999px;
            font-family: inherit; font-size: 0.875rem; font-weight: 600;
            cursor: pointer; transition: all 0.2s ease;
            box-shadow: 0 2px 10px rgba(59, 130, 246, 0.3);
        }
        .btn-logout:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 16px rgba(59, 130, 246, 0.45);
            background: linear-gradient(135deg, #3b82f6, #2563eb);
        }

        .btn-login {
            display: inline-flex; align-items: center; gap: 0.4rem;
            font-size: 0.875rem; font-weight: 600;
            color: var(--blue-600); text-decoration: none;
            padding: 0.45rem 1.1rem; border-radius: 999px;
            border: 1.5px solid var(--blue-300); background: white;
            transition: all 0.2s ease;
        }
        .btn-login:hover {
            background: var(--blue-pastel-bg);
            border-color: var(--blue-400);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
        }

        /* ── Main ── */
        main {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2.5rem 2rem;
            position: relative; z-index: 1;
        }
        nav { position: relative; z-index: 100; }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav>
        <div class="nav-inner">
            <a href="/" class="nav-logo">
                <div class="nav-logo-icon">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                        <path d="M2 17l10 5 10-5"/>
                        <path d="M2 12l10 5 10-5"/>
                    </svg>
                </div>
                <span class="nav-logo">Clinica</span>
            </a>

            <div class="nav-actions">
                @auth
                    <span class="nav-username">
                        {{ auth()->user()->name }}
                    </span>

                    <a href="{{ route('profile.edit') }}" class="btn-profile">
                        Actualizar perfil
                    </a>

                    <form action="{{ route('logout') }}" method="POST" style="margin:0">
                        @csrf
                        <button type="submit" class="btn-logout">
                            Cerrar sesión
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn-login">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
                            <polyline points="10 17 15 12 10 7"/>
                            <line x1="15" y1="12" x2="3" y2="12"/>
                        </svg>
                        Iniciar sesión
                    </a>
                    <a href="{{ route('register') }}" class="btn-login">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
                            <polyline points="10 17 15 12 10 7"/>
                            <line x1="15" y1="12" x2="3" y2="12"/>
                        </svg>
                        Registrarse
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Contenido -->
    <main>
        @yield('content')
    </main>
@if(session('success') || session('error') || session('warning') || session('info'))

<script>

document.addEventListener("DOMContentLoaded", function () {

let icon = "";
let message = "";

@if(session('success'))
    icon = "success";
    message = "{{ session('success') }}";
@endif

@if(session('error'))
    icon = "error";
    message = "{{ session('error') }}";
@endif

@if(session('warning'))
    icon = "warning";
    message = "{{ session('warning') }}";
@endif

@if(session('info'))
    icon = "info";
    message = "{{ session('info') }}";
@endif

Swal.fire({
    toast: true,
    position: 'top-end',
    icon: icon,
    title: message,
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true
});

});

</script>

@endif
</body>
    <!-- FOOTER -->
@section('footer')
<footer class="mt-16 text-center text-sm text-gray-500">

<p>
© {{ date('Y') }} Centro Oftalmológico Virgilio Galvis – Foscal Internacional <br>
Desarrollado por Karen Sepulveda – Todos los derechos reservados.
</p>

</footer>
</html>