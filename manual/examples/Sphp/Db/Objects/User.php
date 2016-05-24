<?php

namespace Sphp\Objects;

use Sphp\Net\Password as Password;

$john = new User();
if ($john->download([User::USERNAME => "johndoe"])) {	
	echo "We have user: $john\n";
	echo "Delete John Doe: ";
	var_dump($john->remove());
}
if (!$john->exists()) {
	$john = (new User())
		->setUsername("johndoe")
		->setFname("John")
		->setLname("Doe")
		->setEmailAddress("john.doe@unknown.com")
		->setAddress((new Address())
				->setStreetaddress("901-6470 Mauris St.")
				->setZipcode("04689")
				->setCity("Canberra")
				->setCountry("Australia"))
		->setPermissions(0b100111)
		->setPassword(new Password("password"));
	echo "\nInsert John Doe: ";
	var_dump($john->insert());
	echo "\n$john";
}
if ($john->exists()) {
	$john->setPhonenumber("112");
	echo "Update John Doe: ";
	var_dump($john->update());
}
?>