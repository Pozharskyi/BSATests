<?php


namespace Acme\Transformers;


class UsersTransformer extends Transformer
{

    public function transform($user)    //Todo return all users books
    {
        return [
            'id' => $user['id'],
            'firstName' => $user['firstname'],
            'lastName' => $user['lastname'],
            'email' => $user['email'],
            'books' => (isset($user['books']) && count($user['books'])) ? array_map([new BooksTransformer(), 'transform'], $user['books']) : null
        ];
    }
}