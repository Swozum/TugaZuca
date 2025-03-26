<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TugaZuca</title>
    <link rel="shortcut icon" href="{{ asset('storage/favicon.jpg') }}">
    @vite('resources/css/app.css')
</head>
<body class="bg-lime-100">
    <div class="min-h-screen flex flex-col items-center justify-center space-y-16">
        <!-- Header -->
        <section id="home" class="w-full bg-white p-10 rounded-2xl shadow-lg text-center mt-0 mb-16">
            <h1 class="text-5xl font-bold text-lime-600">Aulas de Português com Simone</h1>
            <p class="text-gray-700 mt-4 text-xl">Aprenda português de forma simples e eficaz com uma professora experiente!</p>
        </section>
        @yield('main')
    </div>
</body>
</html>