<?php

namespace App\Http\Controllers;

use Acme\Transformers\BooksTransformer;
use App\Book;
use Illuminate\Http\Request;

use App\Http\Requests;
use Response;

class BooksController extends Controller
{
    private $booksTransformer;
    /**
     * BooksController constructor.
     */
    public function __construct(BooksTransformer $booksTransformer)
    {
        $this->booksTransformer = $booksTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return Response::json([
            'data' => $this->booksTransformer->transformCollection($books->all())
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->only('title', 'author', 'year', 'genre');
        $book = Book::create($input);
        return Response::json([
            'data' => $this->booksTransformer->transform($book)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);
        if (!$book) {

            return Response::json([
                'error' => [
                    'message' => 'Book does not exist'
                ]
            ], 404);
        }
        return Response::json([
            'data' => $this->booksTransformer->transform($book)
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        $book->delete();
        return Response::json([
            'success' => true
        ]);
    }




}
