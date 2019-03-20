<?php
namespace Sphp\Core\Security;

use Sphp\Objects\User;
use Sphp\Core\Security\Permissions;
use Sphp\Network\Session\PdoSessionHandler;

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
