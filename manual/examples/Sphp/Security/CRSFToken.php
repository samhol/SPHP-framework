<?php

namespace Sphp\Security;

$token = new CRSFToken();
echo $token->generateToken('foo');
