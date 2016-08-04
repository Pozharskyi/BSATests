<?php

namespace App\Http\Controllers;

use Acme\Transformers\BooksTransformer;
use Acme\Transformers\UsersTransformer;
use App\Book;
use App\Jobs\SendRefundNotificationEmail;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;


class UsersBooksController extends ApiController
{
    private $booksTransformer;
    private $usersTransformer;
    const MAX_BOOK_TAKEN_DAYS = 60 * 60 * 12 * 30;

    /**
     * UsersBooksController constructor.
     * @param $booksTransformer
     */
    public function __construct(BooksTransformer $booksTransformer, UsersTransformer $usersTransformer)
    {
        $this->booksTransformer = $booksTransformer;
        $this->usersTransformer = $usersTransformer;
    }


    /**
     * Display a list of all users books.
     *
     * @param  int $user_id
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        $user = User::find($user_id);
        if (!$user) {
            return $this->respondNotFound('User does not exist');
        }
        $books = $user->books;
        return $this->setStatusCode(200)->respond([
            'data' => $this->booksTransformer->transformCollection($books->all())
        ]);
    }

    /**
     * Add book to user.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $user_id
     * @param  int $book_id
     * @return \Illuminate\Http\Response
     */
    public function update($user_id, Request $request, $book_id)
    {
        $user = User::find($user_id);
        if (!$user) {
            return $this->respondNotFound('User does not exist');
        }
        $book = Book::find($book_id);
        if (!$book) {
            return $this->respondNotFound('Book does not exist');
        }
        $book->user()->associate($user);
        $book->save();
        $user->books;                                   //fetch user with all his books

        $this->dispatch((new SendRefundNotificationEmail($user,$book))->delay(self::MAX_BOOK_TAKEN_DAYS));
        return $this->setStatusCode(200)->respond([
            'data' => $this->usersTransformer->transform($user->toArray())
        ]);
    }

    /**
     * Remove the book from user.
     *
     *
     * @param  int $user_ip
     * @param  int $book_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id, $book_id)
    {
        $book = Book::where('id', $book_id)->where('user_id', $user_id)->first();
        if (!$book) {
            return $this->respondNotFound('User does not has this book');
        }
        $book->user()->dissociate();
        $book->save();
        return $this->setStatusCode(204)->respond([]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id, $book_id)
    {
        $book = Book::where('id', $book_id)->where('user_id', $user_id)->first();
        if (!$book) {
            return $this->respondNotFound('Book does not exist');
        }
        return $this->setStatusCode(200)->respond([
            'data' => $this->booksTransformer->transform($book->toArray())
        ]);
    }
}
