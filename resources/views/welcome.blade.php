@extends('layouts.app')

@section('title','Centro Oftalmológico Virgilio Galvis')

@section('content')

<!-- HERO PREMIUM -->

<section class="relative overflow-hidden rounded-2xl shadow-xl mb-20">

<div class="absolute inset-0">
<img src="/images/oftalmologia.jpg" class="w-full h-full object-cover">
<div class="absolute inset-0 bg-blue-900/60"></div>
</div>

<div class="relative py-32 px-10 text-white text-center">

<h1 class="text-5xl font-bold mb-6 animate-fade">
Centro Oftalmológico Virgilio Galvis
</h1>

<p class="max-w-2xl mx-auto text-lg opacity-90 mb-8 animate-fade">
Comprometidos con la salud visual mediante tecnología avanzada
y atención especializada en Foscal Internacional.
</p>

<div class="flex justify-center gap-4">

<button onclick="openModal()"
class="bg-white text-blue-700 px-6 py-3 rounded-lg font-semibold hover:scale-105 transition">

Razones para visitarnos

</button>

<a href="{{ route('login') }}"
class="bg-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 hover:scale-105 transition">

Ingresar al sistema

</a>

</div>

</div>

</section>


<!-- SECCIÓN PREMIUM -->

<section class="mb-20">

<div class="grid md:grid-cols-2 gap-12 items-center">

<div>

<h2 class="text-3xl font-bold mb-6">
Tecnología avanzada en salud visual
</h2>

<p class="text-gray-600 mb-4">
Nuestro centro oftalmológico cuenta con equipos de última generación
para diagnóstico y tratamiento de enfermedades oculares.
</p>

<p class="text-gray-600">
Trabajamos con estándares internacionales para ofrecer atención
segura, precisa y confiable a todos nuestros pacientes.
</p>

</div>

<div>

<img src="/images/clinica.jpg"
class="rounded-xl shadow-lg">

</div>

</div>

</section>


<!-- ESPECIALIDADES -->

<section class="mb-20">

<h2 class="text-3xl font-bold text-center mb-12">
Especialidades
</h2>

<div class="grid md:grid-cols-3 gap-8">

<div class="bg-white p-6 rounded-xl shadow hover:shadow-xl transition hover:-translate-y-1">

<div class="text-blue-600 text-3xl mb-4">👁</div>

<h3 class="font-semibold text-lg mb-2">
Consulta Oftalmológica
</h3>

<p class="text-gray-600 text-sm">
Evaluación completa de la salud visual con especialistas.
</p>

</div>


<div class="bg-white p-6 rounded-xl shadow hover:shadow-xl transition hover:-translate-y-1">

<div class="text-blue-600 text-3xl mb-4">🔬</div>

<h3 class="font-semibold text-lg mb-2">
Diagnóstico Avanzado
</h3>

<p class="text-gray-600 text-sm">
Tecnología especializada para detectar enfermedades oculares.
</p>

</div>


<div class="bg-white p-6 rounded-xl shadow hover:shadow-xl transition hover:-translate-y-1">

<div class="text-blue-600 text-3xl mb-4">⚕</div>

<h3 class="font-semibold text-lg mb-2">
Tratamientos Especializados
</h3>

<p class="text-gray-600 text-sm">
Procedimientos modernos para el cuidado de la visión.
</p>

</div>

</div>

</section>


<!-- ESTADISTICAS -->

<section class="bg-white rounded-2xl shadow-lg p-12 mb-20">

<div class="grid md:grid-cols-4 text-center gap-10">

<div>
<p class="text-4xl font-bold text-blue-600 counter">25</p>
<p class="text-gray-500">Años de experiencia</p>
</div>

<div>
<p class="text-4xl font-bold text-blue-600 counter">40</p>
<p class="text-gray-500">Especialistas</p>
</div>

<div>
<p class="text-4xl font-bold text-blue-600 counter">10000</p>
<p class="text-gray-500">Pacientes atendidos</p>
</div>

<div>
<p class="text-4xl font-bold text-blue-600">24h</p>
<p class="text-gray-500">Atención médica</p>
</div>

</div>

</section>


<!-- GALERIA CENTRO -->

<!-- GALERIA DEL CENTRO -->

<section class="mb-20">


<h2 class="text-3xl font-bold text-center mb-12">
Nuestros centros
</h2>

<div class="bg-white p-6 rounded-xl shadow hover:shadow-xl transition hover:-translate-y-1">

<p class="text-gray-600 text-sm">
VIOPTICA ¡VEÁMONOS BIEN!
Las Gafas, también conocidas como lentes, gafas o anteojos, son un instrumento óptico utilizado para corregir defectos visuales como la miopía, Hipermetropía, Astigmatismo y presbicia.

Nuestras ópticas cumplen con las características y estándares de calidad requeridos por el especialista.  En el mercado existen diferentes tipos de materiales, armazones y filtros para que el uso de gafas sea un accesorio que a su cara le da mayor belleza y confort.

¡Veamonos bien!
</p>

</div>
<br>

<div class="grid md:grid-cols-3 gap-6">

<img src="/images/centro1.jpg"
class="rounded-xl shadow cursor-pointer hover:scale-105 transition gallery-img">

<img src="/images/centro2.jpg"
class="rounded-xl shadow cursor-pointer hover:scale-105 transition gallery-img">

<img src="/images/centro3.jpg"
class="rounded-xl shadow cursor-pointer hover:scale-105 transition gallery-img">

<img src="/images/centro4.jpg"
class="rounded-xl shadow cursor-pointer hover:scale-105 transition gallery-img">

<img src="/images/centro5.jpg"
class="rounded-xl shadow cursor-pointer hover:scale-105 transition gallery-img">

<img src="/images/centro6.jpg"
class="rounded-xl shadow cursor-pointer hover:scale-105 transition gallery-img">

</div>

</section>

<!-- LIGHTBOX -->

<div id="lightbox"
class="fixed inset-0 bg-black/80 hidden items-center justify-center z-50">

<button onclick="closeLightbox()"
class="absolute top-6 right-6 text-white text-3xl">
✕
</button>

<img id="lightbox-img"
class="max-h-[85vh] rounded-lg shadow-2xl">

</div>


<!-- MAPA -->

<section class="mb-20">

<h2 class="text-3xl font-bold text-center mb-10">
Nuestra ubicación
</h2>

<div class="rounded-xl overflow-hidden shadow-lg">

<iframe
src="https://www.google.com/maps?q=Foscal%20Internacional%20Bucaramanga&output=embed"
width="100%"
height="400"
style="border:0;"
loading="lazy">
</iframe>

</div>

</section>

<!-- CONTACTO -->

<section class="mt-20 bg-white rounded-2xl shadow-lg p-10">

<h2 class="text-3xl font-bold text-center mb-10">
Información de contacto
</h2>

<div class="grid md:grid-cols-3 gap-10 text-center">

<!-- Teléfono -->

<div>

<div class="text-4xl mb-3">📞</div>

<h3 class="font-semibold text-lg mb-2">
Llámanos
</h3>

<p class="text-gray-600">
(7) 6392929
</p>

</div>


<!-- WhatsApp -->

<div>

<div class="text-4xl mb-3">💬</div>

<h3 class="font-semibold text-lg mb-2">
WhatsApp
</h3>

<a href="https://wa.me/573008409433"
target="_blank"
class="text-green-600 font-semibold hover:underline">

300 840 9433

</a>

</div>


<!-- Horario -->

<div>

<div class="text-4xl mb-3">🕒</div>

<h3 class="font-semibold text-lg mb-2">
Horario de atención
</h3>

<p class="text-gray-600 text-sm">

<strong>Lunes a Viernes</strong><br>
8:00 AM – 12:00 PM<br>
2:00 PM – 5:00 PM

<br><br>

<strong>Sábado</strong><br>
8:00 AM – 12:00 PM

</p>

</div>

</div>

</section>

@section('footer')
<footer class="mt-16 text-center text-sm text-gray-500">
    @endsection

<!-- MODAL -->

<div id="modalRazones"
class="fixed inset-0 bg-black/40 hidden items-center justify-center">

<div class="bg-white p-8 rounded-xl max-w-md shadow-xl">

<h3 class="text-xl font-bold mb-4">
¿Por qué elegirnos?
</h3>

<ul class="space-y-2 text-gray-600">

<li>✔ Especialistas certificados</li>
<li>✔ Tecnología avanzada</li>
<li>✔ Atención personalizada</li>
<li>✔ Diagnósticos precisos</li>
<li>✔ Instalaciones modernas</li>

</ul>

<button onclick="closeModal()"
class="mt-6 bg-blue-600 text-white px-4 py-2 rounded">

Cerrar

</button>

</div>

</div>


<script>

function openModal(){
document.getElementById("modalRazones").classList.remove("hidden")
document.getElementById("modalRazones").classList.add("flex")
}

function closeModal(){
document.getElementById("modalRazones").classList.add("hidden")
}

</script>

@endsection
<script>

const images = document.querySelectorAll(".gallery-img");
const lightbox = document.getElementById("lightbox");
const lightboxImg = document.getElementById("lightbox-img");

images.forEach(img => {

img.addEventListener("click", () => {

lightbox.classList.remove("hidden");
lightbox.classList.add("flex");

lightboxImg.src = img.src;

});

});

function closeLightbox(){

lightbox.classList.add("hidden");

}

</script>