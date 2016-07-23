<?php
namespace Acme\Transformers;

class BooksTransformer extends Transformer
{

    function transform($book)
    {
        return [
            'id' => $book['id'],
            'title' => $book['title'],
            'author' => $book['author'],
            'year' => $book['year'],
            'genre' => $book['genre'],
            'userId' => $book['user_id']
        ];
    }
}