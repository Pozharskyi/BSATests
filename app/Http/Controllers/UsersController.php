<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Response;

class UsersController extends Controller
{


    /**
     * Display the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $user->books;
        return Response::json([
            'data' => $this->transform($user)
        ],200);
    }

    private function transform(User $user)
    {
        return [
            'id' => $user->id,
            'firstName' => $user->firstname,
            'lastName' => $user->lastname,
            'email' => $user->email
        ];
    }

}
