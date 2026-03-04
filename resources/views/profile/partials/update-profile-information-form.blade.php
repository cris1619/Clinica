<section>

    <header>
        <h2 class="text-lg font-semibold text-gray-800">
            Información del perfil
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Actualiza tu nombre y correo electrónico.
        </p>
    </header>

    <!-- Formulario para reenviar verificación -->
    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- Formulario principal -->
    <form method="POST" action="{{ route('profile.update') }}" class="mt-6 space-y-5">
        @csrf
        @method('PATCH')

        <!-- Nombre -->
        <div>
            <label class="block text-sm font-medium text-gray-700">
                Nombre
            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name', $user->name) }}"
                class="mt-1 w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                required
                autofocus
            >

            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label class="block text-sm font-medium text-gray-700">
                Correo electrónico
            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email', $user->email) }}"
                class="mt-1 w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                required
            >

            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3">
                    <p class="text-sm text-orange-600">
                        Tu correo no está verificado.
                    </p>

                    <button
                        type="submit"
                        form="send-verification"
                        class="text-sm text-blue-600 underline hover:text-blue-800 mt-1">
                        Reenviar correo de verificación
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm text-green-600">
                            Se ha enviado un nuevo enlace de verificación.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Botón -->
         <br>
        <div class="flex items-center gap-4">
            <button
                type="submit"
                class="bg-blue-500 hover:bg-blue-600 text-black px-5 py-2 rounded-lg shadow transition">
                Guardar cambios
            </button>

            @if (session('status') === 'profile-updated')
                <p class="text-sm text-green-600">
                    Información actualizada correctamente.
                </p>
            @endif
        </div>

    </form>

</section>