<?php


namespace Acme\Transformers;


class UsersTransformer extends Transformer
{

    public function transform($user)
    {
        return [
            'id' => $user['id'],
            'firstName' => $user['firstname'],
            'lastName' => $user['lastname'],
            'email' => $user['email'],
            //get transfer json model for users books
            'books' => (isset($user['books']) && count($user['books'])) ? array_map([new BooksTransformer(), 'transform'], $user['books']) : null
        ];
    }
}