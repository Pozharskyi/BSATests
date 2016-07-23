<?php

namespace App\Http\Controllers;

use Acme\Transformers\UsersTransformer;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Response;

class UsersController extends ApiController
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
        $user = User::find($id);
        if (!$user) {
            return $this->respondNotFound('User does not exist');
        }
        $user->books;
        return $this->setStatusCode(200)->respond([
            'data' => $this->usersTransformer->transform($user->toArray())
        ]);
    }


}
