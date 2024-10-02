<?php

namespace App\actions;

use App\Models\User;

class Users
{
    public static function index($params = [])
    {
        if (empty($params)) {
            return User::query()->get()->toArray();
        }
        foreach ($params as $kye => $value) {
            if ($kye == 'q') {
                if (array_key_exists('email', $value)) {
                    $email = $value['email'];
                } elseif (array_key_exists('first_name', $value)) {
                    $first_name = $value['first_name'];
                } elseif (array_key_exists('last_name', $value)) {
                    $last_name = $value['last_name'];
                }
            } /*elseif ($kye == 's') {
                $sort = explode(':', $value);
                $user4 = User::query()->orderBy($sort[0], $sort[1])->get()->toArray();
                print_r($user4);
            }*/
        }
        $result[] = User::query()->where('email', $email)->get()->toArray();
        $result[] = User::query()->where('first_name', $first_name)->get()->toArray();
        $result[] = User::query()->where('last_name', $last_name)->get()->toArray();


        return $result;
    }
    public static function create($params)
    {
        $newUser = new User($params);

        if (array_key_exists('password', $params)) {
            $newUser->password = password_hash($params['password'], PASSWORD_DEFAULT);
        } else {
            return 'Заполните "password"';
        };

        $newUser->save();
        return $newUser;
    }


    public static function update($id, $params)
    {
        if ($user = User::findOrFail($id)) {
            $user->fill($params);
            if (array_key_exists('password', $params)) {
                $user->password = password_hash($params['password'], PASSWORD_DEFAULT);
            };
            $user->save();
        } else {
            return falce;
        }

        return $user;
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
