<?php

namespace App\Http\Controllers;

use Acme\Transformers\UsersTransformer;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Response;

class UsersController extends Controller
{

    private $usersTransformer;

    /**
     * UsersController constructor.
     * @param $usersTransformer
     */
    public function __construct(UsersTransformer $usersTransformer)
    {
        $this->usersTransformer = $usersTransformer;
    }


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
            'data' => $this->usersTransformer->transform($user)
        ],200);
    }


}
