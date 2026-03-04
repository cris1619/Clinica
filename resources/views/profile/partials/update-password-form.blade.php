<section>

    <header>
        <h2 class="text-lg font-semibold text-gray-800">
            Actualizar contraseña
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Usa una contraseña larga y segura para proteger tu cuenta.
        </p>
    </header>

    <form method="POST" action="{{ route('password.update') }}" class="mt-6 space-y-5">
        @csrf
        @method('PUT')

        <!-- Contraseña actual -->
        <div>
            <label class="block text-sm font-medium text-gray-700">
                Contraseña actual
            </label>

            <input
                type="password"
                name="current_password"
                class="mt-1 w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                required
            >

            @error('current_password', 'updatePassword')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Nueva contraseña -->
        <div>
            <label class="block text-sm font-medium text-gray-700">
                Nueva contraseña
            </label>

            <input
                type="password"
                name="password"
                class="mt-1 w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                required
            >

            @error('password', 'updatePassword')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirmar contraseña -->
        <div>
            <label class="block text-sm font-medium text-gray-700">
                Confirmar contraseña
            </label>

            <input
                type="password"
                name="password_confirmation"
                class="mt-1 w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                required
            >

            @error('password_confirmation', 'updatePassword')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Botón -->
         <br>
        <div class="flex items-center gap-4">
            <button
                type="submit"
                class="bg-blue-500 hover:bg-blue-600 text-black px-5 py-2 rounded-lg shadow transition">
                Guardar cambios
            </button>

            @if (session('status') === 'password-updated')
                <p class="text-sm text-green-600">
                    Contraseña actualizada correctamente.
                </p>
            @endif
        </div>

    </form>

</section>