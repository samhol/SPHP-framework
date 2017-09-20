<?php

namespace Sphp\Security;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$crsfToken = Apis::sami()->classLinker(CRSFToken::class);

\Sphp\Manual\parseDown(<<<MD
##Cross-site request forgery protection 
        
**Good Articles about CRSF:**

 - [Wikipedia](https://en.wikipedia.org/wiki/Cross-site_request_forgery){target="_blank"}


Framework introduces a simple instantiable class $crsfToken for CRSF token generation. 
This class requires running PHP session in order for it to work.
 
1. Tokens are created by calling {$crsfToken->methodLink('generateToken', false)}.
2. Tokens can be verified by:
  - {$crsfToken->methodLink('verifyInputToken', false)} for user defined type of request data
  - {$crsfToken->methodLink('verifyGetToken', false)} for `GET` data
  - {$crsfToken->methodLink('verifyPostToken', false)} for `POST` data

MD
);


CodeExampleBuilder::visualize('Sphp/Security/CRSFToken.php', 'text', false);

