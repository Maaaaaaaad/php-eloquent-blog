<?php

namespace App\actions;

use App\Models\User;

class Users
{
    public static function index()
    {
        return User::all();
    }

    public static function create($params)
    {
        $newUser = new User();

        if (array_key_exists('first_name', $params)) {
            $newUser->first_name = $params['first_name'];
        } else {
            return 'Заполните "first_name"';
        };

        if (array_key_exists('last_name', $params)) {
            $newUser->last_name = $params['last_name'];
        } else {
            return 'Заполните "last_name"';
        };
        if (array_key_exists('email', $params)) {
            $newUser->email = $params['email'];
        } else {
            return 'Заполните "email"';
        };
        if (array_key_exists ('password', $params)) {
            $newUser->password = password_hash( $params['password'], PASSWORD_DEFAULT);
        } else {
            return 'Заполните "password"';
        };

        $newUser->save();

        dump($newUser->id);

        return User::find($newUser->id) ;
    }


    public static function update($id, $params)
    {

        if ($user = User::findOrFail($id)) {
            if (array_key_exists('first_name', $params)) {
                $user->first_name = $params['first_name'];
            };
            if (array_key_exists('last_name', $params)) {
                $user->last_name = $params['last_name'];
            };
            if (array_key_exists('email', $params)) {
                $user->email = $params['email'];
            };
            if (array_key_exists ('password', $params)) {
                $user->password = password_hash( $params['password'], PASSWORD_DEFAULT);
            };
            $user->save();
        } else return falce;

        return User::find($id);
    }

    public static function delete($id)
    {
        $user = User::find($id);
        if (!$user) {
            return false;
        }

        return $user->delete();
    }
}
