<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mi Sistema')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-gray-800">
                Mi Sistema
            </h1>

            <div class="flex items-center gap-4">
                @auth
                    <span class="text-gray-600">
                        {{ auth()->user()->name }}
                    </span>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                            Cerrar sesión
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-blue-600 hover:underline">
                        Iniciar sesión
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Contenido -->
    <main class="max-w-7xl mx-auto p-6">
        @yield('content')
    </main>

</body>
</html>