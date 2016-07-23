<?php

namespace App\Http\Controllers;

use Acme\Transformers\BooksTransformer;
use App\Book;
use Illuminate\Http\Request;

use App\Http\Requests;
use Response;
use Validator;

class BooksController extends ApiController
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
        return $this->setStatusCode(200)->respond([
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
        $rules = [
            'year' => 'required|integer',
            'title' => 'required|regex:/^[(a-zA-Z\s)]+$/u',         //Regex for words with spaces
            'author' => 'required|regex:/^[(a-zA-Z\s)]+$/u',
            'genre' => 'required|alpha'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->respondUnprocessableEntity('Request is not valid');
        } else {
            $input = $request->only('title', 'author', 'year', 'genre');
            $book = Book::create($input);
            return $this->setStatusCode(201)->respond([
                'data' => $this->booksTransformer->transform($book)
            ]);
        }


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
            return $this->respondNotFound('Book does not exist');
        }
        return $this->setStatusCode(200)->respond([
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
        $book = Book::find($id);
        if (!$book) {
            return $this->respondNotFound('Book does not exist');
        }
        $book->delete();
        return $this->setStatusCode(204)->respond([]);
    }


}
