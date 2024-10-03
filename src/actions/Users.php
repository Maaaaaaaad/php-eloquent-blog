<?php

namespace App\actions;

use App\Models\User;

class Users
{
    public static function index($params = [])
    {
        $result = [];
        if (empty($params)) {
            return User::query()->get()->toArray();
        }
        foreach ($params as $kye => $value) {
            if ($kye == 'q') {
                if (array_key_exists('email', $value)) {
                    $email = $value['email'];
                    $result[] = User::query()->orWhere('email', $email)->get()->toArray();
                };
                if (array_key_exists('first_name', $value)) {
                    $first_name = $value['first_name'];
                    dump($first_name);
                    $result[] = User::query()->orWhere('first_name', $first_name)->get()->toArray();
                    dump($result);
                };
                if (array_key_exists('last_name', $value)) {
                    $last_name = $value['last_name'];
                    $result[] = User::query()->orWhere('last_name', $last_name)->get()->toArray();
                };
            } elseif ($kye == 's') {
                $sort = explode(':', $value);
                $result = User::query()->orderBy($sort[0], $sort[1])->get();
            }
        }

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
