<div>
    <h1>Books</h1>
    <a href="{{ route('books.create') }}">Add Book</a>

    @if($books->isEmpty())
        <p>No books found.</p>
    @else
        <table border="1">
            <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Year</th>
                <th>ISBN</th>
                <th>Genre</th>
                <th>Name and Surname</th>
                <th>Borrow Date</th>
                <th>Return Date</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->year }}</td>
                    <td>{{ $book->isbn }}</td>
                    <td>{{ $book->genre }}</td>
                    <td>{{ $book->name }}</td>
                    <td>{{ $book->borrow_date }}</td>
                    <td>{{ $book->return_date }}</td>
                    <td>
                        <a href="{{ route('books.edit', $book->id) }}">Update</a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST"
                              style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('Are you sure you want to delete this reservation?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <p>Total books: {{ $total = $books->count() }}</p>
        <p>Borrowed books: {{ $borrowed = $books->whereNotNull('name')->count() }}</p>
    @endif
</div>
