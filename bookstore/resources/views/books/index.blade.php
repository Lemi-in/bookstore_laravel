<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Books List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if(session('success'))
                        <div class="mb-4 text-green-500">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($books->count())
                        <table class="w-full table-auto text-left">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">Title</th>
                                    <th class="px-4 py-2">Author</th>
                                    <th class="px-4 py-2">Price</th>
                                    <th class="px-4 py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($books as $book)
                                    <tr class="border-b">
                                        <td class="px-4 py-2">{{ $book->title }}</td>
                                        <td class="px-4 py-2">{{ $book->author }}</td>
                                        <td class="px-4 py-2">${{ $book->price }}</td>
                                        <td class="px-4 py-2">
                                            <a href="{{ route('books.edit', $book) }}" class="text-blue-500">Edit</a> |
                                            <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Delete this book?')" class="text-red-500">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4">
                            {{ $books->links() }}
                        </div>
                    @else
                        <p>No books found.</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
