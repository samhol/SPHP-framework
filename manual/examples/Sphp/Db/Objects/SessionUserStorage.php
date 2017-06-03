<?php

namespace Sphp\Db\Objects;

$users = new SessionUserStorage();
$john = $users->findByUserPass('johndoe', 'password');

if ($john !== null) {
  echo "Hello {$john->getUsername()}\n";
} else {
  echo "You are not welcome!\n";
}
echo "\nFirst 5 of {$users->count()} total users:\n";
foreach ($users->get(5, 0, ['username' => 'ASC']) as $user) {
  echo "\tusername: {$user->getUsername()}\n";
}
