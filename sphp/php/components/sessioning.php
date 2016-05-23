<?php

/**
 * This script generates:
 *
 * - a Session object in variable $session
 * - an $currentUser variable that points to the currently logged in user
 *    (User object) or NULL
 * - $currentPermissions variable for current permissions
 */

namespace Sphp\Net;

use Sphp\Objects\User as User;
use Sphp\Util\Permissions as Permissions;

try {
  $sessionHandler = new PdoSessionHandler();
  $sessionHandler->startSession();
  $currentUser = $sessionHandler->getCurrentUser();
  if ($currentUser instanceof User) {
    $currentPermissions = $currentUser->getPermissions();
  } else {
    $currentPermissions = new Permissions();
  }
} catch (\Exception $e) {
  $currentUser = null;
  $currentPermissions = new Permissions();
}

//$sessionHandler->setLocale(LC_MESSAGES, "fi_FI")->useTextDomain("Sphp.Validation");
