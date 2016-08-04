<p>
    Dear, {{$user->firstname}} {{$user->lastname}}. New book {{ $book->title }} is now available in out library!
</p>
<p>
    <a href="{{ route('books.index') }}">Library</a>
</p>
