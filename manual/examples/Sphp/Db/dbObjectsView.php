<?php

namespace Sphp\Db\Objects;

use Sphp\Db\Objects\User as User;
use Sphp\Db\Objects\Address as Address;
use Sphp\Net\Password as Password;

//require_once 'User.php';

$userView = new Users();
try {
	$users = $userView->findByProperty("foo", "bar");
} catch (\Exception $ex) {
	echo get_class($ex) . ": " . $ex->getMessage() . "\n";
}
if ($userView->contains($john)) {
	echo "\njohndoe exists";
	$john = $userView->find(['username' => 'johndoe'])[0];
	echo "\nDelete johndoe: ";
	var_dump($john->remove());
	//var_dump($userView->delete($user));
} else {
	$john = (new User())
			->setUsername("johndoe")
			->setFname("John")
			->setLname("Doe")
			->setEmailAddress("john.doe@unknown.com")
			->setAddress((new Address())
					->setStreetaddress("901-6470 Mauris St.")
					->setZipcode("4689")
					->setCity("Canberra")
					->setCountry("Australia"))
			->setPermissions(0b100111)
			->setPassword(new Password("¤#Ev_@g3g33"));
	echo "Insert John Doe as a new user\n";
	$john->insert();
}
if (!$john->exists()) {
} else {
	echo "Update John Doe\n";
	$john->update();
}
//var_dump($userView->upload($john));
//echo "user: " . $userView[205];
echo $userView->findByUsername("johdoe");
