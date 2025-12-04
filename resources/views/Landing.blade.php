<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Book Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        .hero-bg {
            background: url('https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?auto=format&fit=crop&w=1470&q=80') no-repeat center center;
            background-size: cover;
        }
    </style>
</head>

<body class="flex flex-col min-h-screen" x-data="{ loginOpen: false, signupOpen: false }">

    <header class="bg-blue-700 text-white py-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center px-6">
            <h1 class="text-2xl font-bold">📚 E-Book Store</h1>

            <nav class="flex space-x-4">
                <a href="/" class="hover:text-gray-200 transition">Home</a>
                <a href="/books" class="hover:text-gray-200 transition">Books</a>
            </nav>

            <div class="flex space-x-4">
                <button @click="loginOpen = true"
                    class="bg-white text-blue-700 px-4 py-2 rounded hover:bg-gray-100 transition font-semibold">
                    Login
                </button>
                <button @click="signupOpen = true"
                    class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition font-semibold">
                    Sign Up
                </button>
            </div>
        </div>
    </header>

    <section class="hero-bg bg-gradient-to-r from-blue-600 via-blue-500 to-blue-400 py-32">
        <div class="flex flex-col md:flex-row items-center justify-between max-w-6xl mx-auto px-6 md:gap-16 gap-10">
            <div class="text-left mb-10 md:mb-0">
                <h2 class="text-5xl md:text-7xl font-extrabold mb-6 text-white">E-Book Store</h2>
                <p class="text-xl md:text-2xl text-white mb-8">
                    Explore thousands of books, manage your loans, and track your reading journey—all in one place.
                </p>
                <a href="/books"
                    class="bg-blue-700 text-white px-10 py-5 rounded-xl font-bold text-lg hover:bg-blue-800 transition">
                    Browse Books
                </a>
            </div>

            <div class="max-w-md md:max-w-lg">
                <img src="https://images.unsplash.com/photo-1512820790803-83ca734da794?auto=format&fit=crop&w=800&q=80"
                    alt="Library" class="rounded-xl shadow-lg w-full object-cover">
            </div>
        </div>
    </section>

    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-6 text-center">
            <h3 class="text-3xl font-bold mb-12">Why Choose E-Book Store?</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition flex flex-col items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-600 mb-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 16h8M8 12h8m-6-8h6a2 2 0 012 2v16H6V6a2 2 0 012-2h6z" />
                    </svg>
                    <h4 class="font-semibold text-xl mb-2">Easy Book Search</h4>
                    <p class="text-gray-600">Find books quickly with our smart search and categories.</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition flex flex-col items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-600 mb-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6M5 9h14M5 13h14M5 17h14" />
                    </svg>
                    <h4 class="font-semibold text-xl mb-2">Loan Management</h4>
                    <p class="text-gray-600">Keep track of borrowed books and due dates with ease.</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition flex flex-col items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-purple-600 mb-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <h4 class="font-semibold text-xl mb-2">Personal Dashboard</h4>
                    <p class="text-gray-600">Manage your reading history, favorites, and recommendations.</p>
                </div>

            </div>
        </div>
    </section>

    <footer class="bg-blue-700 text-white py-6 mt-auto">
        <div class="container mx-auto text-center">
            &copy; {{ date('Y') }} MyLibrary. All rights reserved.
        </div>
    </footer>

    <div x-show="loginOpen" x-transition
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div @click.away="loginOpen = false" class="bg-white p-8 rounded-lg shadow-lg w-96">

            <h2 class="text-2xl font-bold mb-4">Login</h2>

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded text-center">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login.perform') }}" method="POST" class="flex flex-col space-y-4">
                @csrf
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"
                    class="border p-2 rounded w-full">
                <input type="password" name="password" placeholder="Password" class="border p-2 rounded w-full">

                <button type="submit"
                    class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800 transition font-semibold">
                    Login
                </button>
            </form>

            <div class="mt-6 text-center">
                <button @click="loginOpen = false"
                    class="px-4 py-2 border border-red-500 text-red-500 rounded hover:bg-red-100 transition font-semibold">
                    Close
                </button>
            </div>
        </div>
    </div>

    <div x-show="signupOpen" x-transition
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div @click.away="signupOpen = false" class="bg-white p-8 rounded-lg shadow-lg w-96">
            <h2 class="text-2xl font-bold mb-4">Sign Up</h2>

            @if (session('success') || session('error'))
                <div id="alert"
                    class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 
                        px-6 py-4 rounded-lg text-white shadow-lg z-50 text-lg font-semibold
                        {{ session('success') ? 'bg-green-500' : 'bg-red-500' }}">
                    {{ session('success') ?? session('error') }}
                </div>

                <script>
                    setTimeout(() => {
                        const alert = document.getElementById('alert');
                        if (alert) alert.remove();
                    }, 3000);
                </script>
            @endif

            <form action="{{ route('register.store') }}" method="POST" class="flex flex-col space-y-4">
                @csrf
                <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}"
                    class="border p-2 rounded w-full">
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"
                    class="border p-2 rounded w-full">
                <input type="password" name="password" placeholder="Password" class="border p-2 rounded w-full">
                <input type="password" name="password_confirmation" placeholder="Confirm Password"
                    class="border p-2 rounded w-full">

                <button type="submit"
                    class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition font-semibold">
                    Sign Up
                </button>
            </form>

            <div class="mt-6 text-center">
                <button @click="signupOpen = false"
                    class="px-4 py-2 border border-red-500 text-red-500 rounded hover:bg-red-100 transition font-semibold">
                    Close
                </button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>

</html>
