<?php

namespace App;

class User
{
    private $currentSubscription;
    private $email;

    public function __construct($email, $currentSubscription = null)
    {
        $this->email = $email;
        $this->currentSubscription = $currentSubscription ?? new FakeSubscription($this);

    }

    public function getCurrentSubscription()
    {
        return $this->currentSubscription;
    }

    public function isAdmin()
    {
        return $this->email === 'rakhim@hexlet.io';
    }
}
