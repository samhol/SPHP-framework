<?php

namespace Sphp\Db\Objects;

use Doctrine\ORM\EntityManagerInterface as EntityManagerInterface;
use Sphp\Core\Configuration as Configuration;
use Exception;
use Sphp\Net\Password as Password;

$john = include 'User.php';

$entityManager = Configuration::useDomain("manual")->get(EntityManagerInterface::class);
$users = new Users($entityManager);
try {
	$foobar = $users->findByProperty("foo", "bar");
} catch (Exception $ex) {
	echo get_class($ex) . ": " . $ex->getMessage() . "\n";
}
try {
	$samhol = $users->findByProperty("username", "samhol");
} catch (Exception $ex) {
	echo get_class($ex) . ": " . $ex->getMessage() . "\n";
}
try {
	$samhol1 = $users->findBy(["username" => "samhol", "fname" => "Sami"]);
} catch (Exception $ex) {
	echo get_class($ex) . ": " . $ex->getMessage() . "\n";
}
var_dump($samhol == $samhol1);
if ($users->contains($john)) {
	echo "\njohndoe exists";
	$john = $users->find([User::USERNAME => "johndoe"])[0];
	echo "\nDelete johndoe: ";
	var_dump($john->remove());
	//var_dump($userView->delete($user));
} else {
	//$john->insertInto($entityManager);
	//echo "Insert John Doe as a new user\n";
	//$john->insert();
}
/*if (!$john->exists()) {
} else {
	echo "Update John Doe\n";
	$john->update();
}*/
//var_dump($userView->upload($john));
//echo "user: " . $userView[205];
echo $users->findByUsername("samhol");
?>
