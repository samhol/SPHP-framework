<?php

/**
 * This script generates:
 *
 * - a Session object in variable $session
 * - an $currentUser variable that points to the currently logged in user
 *    (User object) or NULL
 * - $currentPermissions variable for current permissions
 */

namespace Sphp\Session;

include_once("../settings.php");

use Sphp\items\User as User;
use Sphp\items\Permissions as Permissions;
use Sphp\sql\RefereeTable as RefereeTable;

try {
	$session = new Session();
	$session->start();
	$currentUser = $session->getCurrentUser();
	if ($currentUser instanceof User) {
		$refereeTable = new RefereeTable();
		if ($refereeTable->contains($currentUser)) {
			$currentUser = $refereeTable->getById($currentUser);
		}
		$currentPermissions = $currentUser->getPermissions();
	} else {
		$currentPermissions = new Permissions();
	}
} catch (\Exception $e) {
	$currentUser = new User();
	$currentPermissions = new Permissions();
}