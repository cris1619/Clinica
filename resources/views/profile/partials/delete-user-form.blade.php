<section class="space-y-6">

    <header>
        <h2 class="text-lg font-semibold text-gray-800">
            Eliminar cuenta
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Una vez elimines tu cuenta, todos tus datos serán eliminados permanentemente.
            Esta acción no se puede deshacer.
        </p>
    </header>

    <button 
        onclick="openModal()"
        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg shadow transition">
        Eliminar cuenta
    </button>

    <!-- Modal -->
    <div id="modalDelete"
         class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 transition-opacity">

        <div onclick="event.stopPropagation()"
             class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 transform transition-all">

            <h2 class="text-lg font-semibold text-gray-800 mb-2">
                Confirmar eliminación
            </h2>

            <p class="text-sm text-gray-600 mb-4">
                Para confirmar esta acción, ingresa tu contraseña.
            </p>

            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('DELETE')

                <input 
                    type="password"
                    name="password"
                    placeholder="Contraseña"
                    class="w-full border rounded-lg px-3 py-2 mb-3 focus:outline-none focus:ring-2 focus:ring-red-500"
                    required
                >

                @error('password', 'userDeletion')
                    <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
                @enderror

                <div class="flex justify-end gap-3">
                    <button type="button"
                        onclick="closeModal()"
                        class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 transition">
                        Cancelar
                    </button>

                    <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                        Sí, eliminar
                    </button>
                </div>
            </form>

        </div>
    </div>

</section>

<script>
function openModal() {
    const modal = document.getElementById('modalDelete');
    modal.classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
}

function closeModal() {
    const modal = document.getElementById('modalDelete');
    modal.classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

// Cerrar al hacer click fuera del cuadro
document.getElementById('modalDelete')?.addEventListener('click', closeModal);

// Cerrar con tecla ESC
document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
        closeModal();
    }
});
</script>