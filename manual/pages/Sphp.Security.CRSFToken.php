<?php

namespace Sphp\Security;

use Sphp\Manual;

$crsfToken = Manual\api()->classLinker(CRSFToken::class);

Manual\md(<<<MD
##Cross-site request forgery protection 
        
**Good Articles about CRSF:**

 - [Wikipedia](https://en.wikipedia.org/wiki/Cross-site_request_forgery){target="_blank"}


Framework introduces a simple instantiable class $crsfToken for CRSF token generation. 
This class requires running PHP session in order for it to work.
MD
);

Manual\example('Sphp/Security/CRSFToken.php', 'html5', false)
        ->setExamplePaneTitle('An Example of Token used in a HTML form')
        ->printHtml();

Manual\md(<<<MD
1. Tokens are created by calling {$crsfToken->methodLink('generateToken', false)}.
2. Tokens can be verified by:
  - {$crsfToken->methodLink('verifyInputToken', false)} for user defined type of request data
  - {$crsfToken->methodLink('verifyGetToken', false)} for `GET` data
  - {$crsfToken->methodLink('verifyPostToken', false)} for `POST` data

MD
);

