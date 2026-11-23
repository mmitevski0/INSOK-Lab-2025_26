<h1>Create Book</h1>

<form action="{{ route('books.store') }}" method="POST">
    @csrf

    <label for="title">Title:</label><br>
    <input type="text" id="title" name="title" required><br><br>

    <label for="author">Author:</label><br>
    <input type="text" id="author" name="author" required><br><br>

    <label for="year">Year:</label><br>
    <input type="number" id="year" name="year" required><br><br>

    <label for="isbn">ISBN:</label><br>
    <input type="text" id="isbn" name="isbn" required><br><br>

    <label for="genre">Genre:</label><br>
    <input type="text" id="genre" name="genre" required><br><br>

    <label for="name">Name and surname:</label><br>
    <input type="text" id="name" name="name"><br><br>

    <label for="borrow_date">Borrow date:</label><br>
    <input type="date" id="borrow_date" name="borrow_date"><br><br>

    <label for="return_date">Return date:</label><br>
    <input type="date" id="return_date" name="return_date"><br><br>

    <button type="submit">Create Book</button>
</form>
