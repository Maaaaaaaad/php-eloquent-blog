<?php

namespace App\KeyValueFunctions;

require __DIR__ . '/../vendor/autoload.php';

use App\Subscription;
use App\User;



$user = new User('vasya@email.com', new Subscription('premium'));
dump($user);
dump($user->getCurrentSubscription()->hasPremiumAccess()); // true
dump($user->getCurrentSubscription()->hasProfessionalAccess()); // false

$user = new User('vasya@email.com', new Subscription('professional'));
dump($user);
dump($user->getCurrentSubscription()->hasPremiumAccess()); // false
dump($user->getCurrentSubscription()->hasProfessionalAccess()); // true

// Внутри создается фейковая, потому что подписка не передается

$user = new User('vasya@email.com');
dump($user);

dump($user->getCurrentSubscription()->hasPremiumAccess()); // false
dump($user->getCurrentSubscription()->hasProfessionalAccess()); // false



$user = new User('rakhim@hexlet.io'); // администратор, проверяется по емейлу
dump($user);

dump($user->getCurrentSubscription()->hasPremiumAccess()); // true
dump($user->getCurrentSubscription()->hasProfessionalAccess()); // true