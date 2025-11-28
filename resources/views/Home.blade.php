<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col items-center justify-center min-h-screen bg-gray-100">

    <h1 class="text-3xl font-bold mb-6">Welcome, {{ Auth::user()->name ?? 'Guest' }}!</h1>

    @auth
        <form action="{{ route('logout.perform') }}" method="POST">
            @csrf
            <button type="submit" class="px-6 py-3 bg-red-500 text-white rounded hover:bg-red-600 transition font-semibold">
                Logout
            </button>
        </form>
    @else
        <p class="text-gray-700">You are not logged in.</p>
    @endauth

</body>
</html>
