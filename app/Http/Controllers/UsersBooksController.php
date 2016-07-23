<?php

namespace App\Http\Controllers;

use App\Book;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Response;

class UsersBooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  int $user_id
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        $user = User::findOrFail($user_id);
        $books = $user->books;
        return Response::json([
            'data' => $books
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  int $user_id
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store($user_id, Request $request)
    {
        $user = User::findOrFail($user_id);
        $book = Book::findOrFail($request->id);
//        $book->create($request->only('title', 'author', 'year', 'genre'));
        $book->user()->associate($user);
        $book->save();

        return Response::json([
            'data' => $book
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $user_ip
     * @param  int $book_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id, $book_id)
    {
        $book = Book::findOrFail($book_id);
        $book->user()->dissociate();
        $book->save();
        return Response::json([
            'success' => true
        ]);
    }
}
