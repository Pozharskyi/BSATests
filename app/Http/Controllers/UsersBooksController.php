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
     * Add book to user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $user_id
     * @param  int  $book_id
     * @return \Illuminate\Http\Response
     */
    public function update($user_id, Request $request, $book_id)
    {
        $user = User::find($user_id);
        $book = Book::find($book_id);
        $book->user()->associate($user);
        $book->save();
        $user->books;
        return Response::json([
            'data' => $user
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
