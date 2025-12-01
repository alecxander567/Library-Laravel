<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="flex bg-gray-100">

    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
            class="fixed inset-0 flex items-center justify-center z-50 transition-opacity duration-500">
            <div class="bg-green-100 text-green-700 p-4 rounded shadow-lg">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <aside x-data="{ active: 'dashboard' }" @modal-closed.window="active = 'dashboard'"
        class="w-64 bg-blue-700 text-white shadow-md h-screen p-6 fixed left-0 top-0 flex flex-col">
        <h2 class="text-2xl font-bold mb-8">📘 Library</h2>

        <nav class="flex flex-col space-y-4">
            <a href="#" @click.prevent="active = 'dashboard'"
                :class="active === 'dashboard' ? 'bg-blue-800 rounded px-2 py-1' : 'hover:text-blue-200'"
                class="text-lg font-medium">
                📊 Dashboard
            </a>

            <a href="#" @click.prevent="active = 'addBook'; $dispatch('open-modal')"
                :class="active === 'addBook' ? 'bg-blue-800 rounded px-2 py-1' : 'hover:text-blue-200'"
                class="text-lg font-medium">
                📚 Add Book
            </a>

            <a href="#" @click.prevent="active = 'borrowers'"
                :class="active === 'borrowers' ? 'bg-blue-800 rounded px-2 py-1' : 'hover:text-blue-200'"
                class="text-lg font-medium">
                👥 Borrowers
            </a>

            <a href="#" @click.prevent="active = 'outOfDate'"
                :class="active === 'outOfDate' ? 'bg-blue-800 rounded px-2 py-1' : 'hover:text-blue-200'"
                class="text-lg font-medium">
                ⏰ Out of Date
            </a>
        </nav>
    </aside>

    <div x-data="{ open: false }" @open-modal.window="open = true" x-show="open" x-cloak x-transition.opacity
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">

        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6"
            @click.away="open = false; $dispatch('modal-closed')">
            <h2 class="text-xl font-bold mb-4">Add New Book</h2>

            <form action="{{ route('books.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 mb-1">Book Name</label>
                    <input type="text" name="name" class="w-full border px-3 py-2 rounded text-black" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-1">Author</label>
                    <input type="text" name="author" class="w-full border px-3 py-2 rounded text-black" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-1">Quantity</label>
                    <input type="number" name="available" class="w-full border px-3 py-2 rounded text-black"
                        min="0" value="1" required>
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" @click="open = false; $dispatch('modal-closed')"
                        class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Cancel</button>
                    <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Add
                        Book</button>
                </div>
            </form>
        </div>
    </div>
    <!-- EDIT BOOK MODAL -->
    <div class="modal fade" id="editBookModal" tabindex="-1" aria-labelledby="editBookModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content rounded-lg shadow-lg p-6">
                <div class="modal-header border-0 px-0 pb-3">
                    <h5 class="modal-title text-xl font-bold text-blue-600" id="editBookModalLabel">Edit Book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="editBookForm" method="POST" action="" class="px-0">
                    @csrf
                    @method('PUT')
                    <div class="modal-body px-0">
                        <div class="mb-4">
                            <label for="bookName" class="block text-gray-700 mb-1">Book Name</label>
                            <input type="text" class="w-full border px-3 py-2 rounded text-black" id="bookName"
                                name="name">
                        </div>

                        <div class="mb-4">
                            <label for="bookAuthor" class="block text-gray-700 mb-1">Author</label>
                            <input type="text" class="w-full border px-3 py-2 rounded text-black" id="bookAuthor"
                                name="author">
                        </div>

                        <div class="mb-4">
                            <label for="bookAvailable" class="block text-gray-700 mb-1">Available</label>
                            <input type="number" class="w-full border px-3 py-2 rounded text-black"
                                id="bookAvailable" name="available" min="0">
                        </div>
                    </div>

                    <div class="modal-footer px-0 border-0 flex justify-end space-x-3">
                        <button type="button" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit"
                            class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Update Book</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- DELETE BOOK MODAL -->
    <div class="modal fade" id="deleteBookModal" tabindex="-1" aria-labelledby="deleteBookModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content rounded-lg shadow-lg p-6">
                <div class="modal-header border-0 px-0 pb-3">
                    <h5 class="modal-title text-xl font-bold text-red-600" id="deleteBookModalLabel">Delete Book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="deleteBookForm" method="POST" class="px-0">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body px-0">
                        <p class="text-gray-700">Are you sure you want to delete this book?</p>
                    </div>

                    <div class="modal-footer px-0 border-0 flex justify-end space-x-3">
                        <button type="button" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit"
                            class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <main class="ml-64 flex-1">

        <header class="w-full bg-blue-600 text-white shadow flex items-center justify-between px-8 py-4">
            <h1 class="text-2xl font-bold">Dashboard</h1>

            @auth
                <form action="{{ route('logout.perform') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="px-5 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition font-semibold">
                        Logout
                    </button>
                </form>
            @endauth
        </header>

        <div class="p-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            <div class="bg-white shadow-md rounded-lg p-6 text-center">
                <h2 class="text-xl font-semibold mb-2">Total Books</h2>
                <p class="text-3xl font-bold text-blue-600">{{ $books->count() }}</p>
            </div>

            <div class="bg-white shadow-md rounded-lg p-6 text-center">
                <h2 class="text-xl font-semibold mb-2">Borrowed Books</h2>
                <p class="text-3xl font-bold text-blue-600">0</p>
            </div>

            <div class="bg-white shadow-md rounded-lg p-6 text-center">
                <h2 class="text-xl font-semibold mb-2">Not Available</h2>
                <p class="text-3xl font-bold text-blue-600">
                    {{ $books->where('available', 0)->count() }}
                </p>
            </div>

            <div class="bg-white shadow-md rounded-lg p-6 text-center">
                <h2 class="text-xl font-semibold mb-2">Borrowers</h2>
                <p class="text-3xl font-bold text-blue-600">0</p>
            </div>

        </div>

        <div class="p-8">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Books List</h2>

            <div class="overflow-x-auto bg-white shadow-lg rounded-lg border border-blue-200">
                <table class="min-w-full divide-y divide-blue-200">
                    <thead class="bg-blue-600 text-white rounded-t-lg">
                        <tr>
                            <th class="px-6 py-3 text-left font-medium uppercase tracking-wider">Book No.</th>
                            <th class="px-6 py-3 text-left font-medium uppercase tracking-wider">Book Name</th>
                            <th class="px-6 py-3 text-left font-medium uppercase tracking-wider">Author</th>
                            <th class="px-6 py-3 text-left font-medium uppercase tracking-wider">Available</th>
                            <th class="px-6 py-3 text-center font-medium uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-blue-100 text-gray-700">
                        @foreach ($books as $book)
                            <tr class="hover:bg-blue-50 transition">
                                <td class="px-6 py-4">{{ $book->id }}</td>
                                <td class="px-6 py-4 font-semibold">{{ $book->name }}</td>
                                <td class="px-6 py-4">{{ $book->author }}</td>
                                <td class="px-6 py-4 text-center">{{ $book->available }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button
                                            class="flex items-center px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 text-base transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 10h1l1-2 3 6 4-8 2 4 3-6 1 2h1" />
                                            </svg>
                                            Borrow
                                        </button>

                                        <button
                                            class="flex items-center px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-base transition"
                                            data-bs-toggle="modal" data-bs-target="#editBookModal"
                                            onclick="setEditFormData({{ $book->id }}, '{{ addslashes($book->name) }}', '{{ addslashes($book->author) }}', {{ $book->available }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536M9 13l6-6m0 0l-6 6m6-6L9 19H5v-4l6-6z" />
                                            </svg>
                                            Edit
                                        </button>

                                        <button
                                            class="flex items-center px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 text-base transition"
                                            data-bs-toggle="modal" data-bs-target="#deleteBookModal"
                                            data-id="{{ $book->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <script>
        function setEditFormData(id, name, author, available) {
            document.getElementById('bookName').value = name;
            document.getElementById('bookAuthor').value = author;
            document.getElementById('bookAvailable').value = available;
            document.getElementById('editBookForm').action = '/books/' + id + '/update';
        }

        document.addEventListener('DOMContentLoaded', function() {
            var deleteModal = document.getElementById('deleteBookModal');

            if (deleteModal) {
                deleteModal.addEventListener('show.bs.modal', function(event) {
                    var button = event.relatedTarget;
                    var id = button.getAttribute('data-id');

                    var form = deleteModal.querySelector('#deleteBookForm');
                    if (form) form.action = `/books/${id}/delete`;
                });
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
