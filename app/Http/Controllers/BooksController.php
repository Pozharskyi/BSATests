<?php

namespace App\Http\Controllers;

use Acme\Transformers\BooksTransformer;
use App\Book;
use App\Jobs\SendNewBookNotificationEmail;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Mail;
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

//            $users = User::all();
//            foreach($users as $user){
//                Mail::later(5,'emails.new_book_notify', ['user' => $user, 'book' => $book], function ($message) use ($user){
//                    $message->to($user->email)->subject('New book available');
//                },'default');
//            }

            $this->dispatch(new SendNewBookNotificationEmail($book))->onQueue('LibreryRestFull');
            return $this->respondCreated();

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
            'data' => $this->booksTransformer->transform($book->toArray())
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'year' => 'required|integer',
            'title' => 'required|regex:/^[(a-zA-Z\s)]+$/u',     //Regex for words with spaces
            'author' => 'required|regex:/^[(a-zA-Z\s)]+$/u',
            'genre' => 'required|alpha'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->respondUnprocessableEntity('Request is not valid');
        } else {
//            $book = Book::find($id);
//            if (Gate::denies('updateBook',$book)) {
//                abort(403, 'Access denied');
//            }
//
//            $book->update($request->all());
//
//            Session::flash('message', 'Book has been updated');
//            return redirect()->route('books.index');
            $book = Book::find($id);
            if (!$book) {
                return $this->respondNotFound('Book does not exist');
            }
            $input = $request->only('title', 'author', 'year', 'genre');
            $book->update($input);
            return $this->respondUpdate();
        }
    }

}
