<h1>Edit Book</h1>

<form action="{{ route('books.update', $book->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="title">Title:</label><br>
    <input type="text" id="title" name="title" value="{{ $book->title }}" required><br><br>

    <label for="author">Title:</label><br>
    <input type="text" id="author" name="author" value="{{ $book->author }}" required><br><br>

    <label for="year">Year:</label><br>
    <input type="number" id="year" name="year" value="{{ $book->year }}" required><br><br>

    <label for="isbn">ISBN:</label><br>
    <input type="text" id="isbn" name="isbn" value="{{ $book->isbn }}" required><br><br>

    <label for="genre">Genre:</label><br>
    <input type="text" id="genre" name="genre" value="{{ $book->genre }}" required><br><br>

    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" value="{{ $book->name }}"><br><br>

    <label for="borrow_date">Borrow date:</label><br>
    <input type="date" id="borrow_date" name="borrow_date" value="{{ $book->borrow_date }}"><br><br>

    <label for="return_date">Return date:</label><br>
    <input type="date" id="return_date" name="return_date" value="{{ $book->return_date }}"><br><br>

    <button type="submit">Update Book</button>
</form>
