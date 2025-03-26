@extends('website.base')
@section('main')

        <!-- About & Photo Section -->
        <section id="about" class="w-full grid grid-cols-1 md:grid-cols-2 gap-8 mb-32">
            <div class="flex justify-center">
                <img src="https://artlogic-res.cloudinary.com/w_650,c_limit,f_auto,fl_lossy,q_auto/ws-artlogicwebsite0907/usr/images/artists/group_images_override/items/b4/b4dc5b571eee4154b87bf757f9b50e13/break-away.jpg" alt="Simone's photo" class="object-cover rounded-2xl shadow-lg w-96 h-96 transition-transform duration-500 hover:scale-105">
            </div>
            <div class="bg-white rounded-2xl shadow-lg p-10">
                <h2 class="text-3xl font-bold mb-4 text-lime-600">Sobre a Professora</h2>
                <p class="text-gray-700 text-lg">Simone é uma professora dedicada com anos de experiência ensinando português para diversos níveis. Ela utiliza métodos modernos e práticos para garantir que seus alunos aprendam de maneira eficiente e descontraída.</p>
            </div>
        </section>

        <!-- Activities Section -->
        <section id="activities" class="w-full bg-white rounded-2xl shadow-lg p-10 mb-32">
            <h2 class="text-3xl font-bold mb-8 text-lime-600 text-center">Atividades da Professora</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="flex justify-center">
                    <img src="https://artlogic-res.cloudinary.com/w_1800,h_1320,c_limit,f_auto,fl_lossy,q_auto/ws-artlogicwebsite0907/usr/images/artworks/main_image/items/99/99ad597a5f024db3ad9f6ed1bd358a2f/shemanifestsherdestiny.jpg" 
                    alt="Activity 1" class="object-cover rounded-2xl shadow-lg w-80 h-80 transition-transform duration-500 hover:scale-105">
                </div>
                <div class="flex justify-center">
                    <img src="https://artlogic-res.cloudinary.com/w_1800,h_1320,c_limit,f_auto,fl_lossy,q_auto/ws-artlogicwebsite0907/usr/images/artworks/main_image/items/6e/6ec54ff3b3394051b5c45f18cbd2a132/img_4879.jpeg" 
                    alt="Activity 2" class="object-cover rounded-2xl shadow-lg w-80 h-80 transition-transform duration-500 hover:scale-105">
                </div>
                <div class="flex justify-center">
                    <img src="https://artlogic-res.cloudinary.com/w_1800,h_1320,c_limit,f_auto,fl_lossy,q_auto/ws-artlogicwebsite0907/usr/images/artworks/main_image/items/7a/7ad1d7ffcd9a4c5fa9588a32802ec17b/img_4785.jpeg" 
                    alt="Activity 3" class="object-cover rounded-2xl shadow-lg w-80 h-80 transition-transform duration-500 hover:scale-105">
                </div>
            </div>
            <div class="mt-10 text-center">
                <p class="text-gray-700 text-lg">Veja algumas das atividades realizadas pela professora Simone, que ajudam os alunos a aprender de forma dinâmica e divertida.</p>
            </div>
        </section>

        <!-- Sample Lesson Video Section -->
        <section id="sample-lesson" class="w-full bg-white rounded-2xl shadow-lg p-10 mb-16 text-center">
            <h2 class="text-3xl font-bold mb-4 text-lime-600">Exemplo de Aula</h2>
            <p class="text-gray-700 text-lg mb-6">Confira um exemplo de aula para ver o método de ensino da professora Simone.</p>
            <div class="flex justify-center">
                <!--
                <video controls class="rounded-2xl shadow-lg w-full md:w-3/4 lg:w-1/2">
                    <source src="https://www.youtube.com/watch?v=lHrHQZpK1Os" type="video/mp4">
                </video> -->
                <iframe width="560" height="315" src="https://www.youtube.com/embed/lHrHQZpK1Os?si=HxrKZZ8qkOEWSj_L" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
        </section>

        <!-- Booking & Payment Section -->
        <section id="booking" class="w-full bg-white rounded-2xl shadow-lg p-10 text-center mt-16 mb-16">
            <h2 class="text-3xl font-bold mb-4 text-lime-600">Marcar uma Aula</h2>
            <p class="text-gray-700 text-lg mb-6">
                Escolha um tipo de aula e veja os pacotes disponíveis.
            </p>
        
            <!-- Centered Grid with Responsive Adjustments -->
            <div class="flex justify-center">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 w-full max-w-5xl">
                    @foreach ($types as $type)
                        <a href="{{ route('packages.index', ['typeId' => $type->id]) }}" 
                           class="flex items-center justify-center bg-lime-500 text-white text-xl font-semibold py-6 px-4 
                                  rounded-lg shadow-lg hover:bg-lime-600 transition duration-300 text-center">
                            {{ $type->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
        


        <!-- Contact Section -->
        <section id="contact" class="w-full bg-white rounded-2xl shadow-lg p-10 mb-0 text-center">
            <h2 class="text-3xl font-bold mb-4 text-lime-600">Contato</h2>
            <p class="text-gray-700 text-lg">Entre em contato para mais informações:</p>
            <div class="mt-4 space-y-2">
                <p>Email: <a href="mailto:simone@example.com" class="text-lime-600 hover:underline">simone@example.com</a></p>
                <p>Telefone: <a href="tel:+5511999999999" class="text-lime-600 hover:underline">(11) 99999-9999</a></p>
            </div>
        </section>

@endsection()