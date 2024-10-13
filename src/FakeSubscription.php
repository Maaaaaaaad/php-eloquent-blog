<?php


namespace App;


class FakeSubscription
{
    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function hasProfessionalAccess()
    {
        return $this->user->isAdmin();
    }

    public function hasPremiumAccess()
    {
        return $this->user->isAdmin();
    }
}