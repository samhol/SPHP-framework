<?php

namespace Sphp\Security;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$crsfToken = Apis::sami()->classLinker(CRSFToken::class);

\Sphp\Manual\parseDown(<<<MD
##SQL Injection vulnerabilities

[Database tools](Sphp.Database){target="_blank"} are all         

**Good Articles about SQL injection:**

 - [Wikipedia](https://en.wikipedia.org/wiki/SQL_injection){target="_blank"}
 - [OWASP  article](https://www.owasp.org/index.php/SQL_Injection){target="_blank"}


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

