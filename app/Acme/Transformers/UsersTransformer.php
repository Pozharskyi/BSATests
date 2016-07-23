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
            'email' => $user['email']
        ];
    }
}