<p>
    Dear, {{$user->firstname}} {{$user->lastname}}. Please return the book: {{ $book->title }} to our library.
</p>
<p>
    <a href="{{ route('users.books.index') }}">Your assigned books</a>
</p>
