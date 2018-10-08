<?php

namespace Sphp\Stdlib\Networks;

use Sphp\Manual;

$urlClass = Manual\api()->classLinker(URL::class);
$parse_url = Manual\php()->functionLink('parse_url');
$arrayAccess = Manual\php()->classLinker(\ArrayAccess::class);

\Sphp\Manual\md(<<<MD
##URL manipulation with a $urlClass objects

The syntax for an URI string is: `scheme://[user:pass@]domain:port/path?query#fragment`
		
The $urlClass Implements Uniform resource locator (URL) object. 
These Objects allow users to encode, decode, manipulate and compare URLs.
		
The {$urlClass->methodLink('__construct')} parses the input URL string
with $parse_url function and the class $urlClass is therefore 
intended specifically for the  URLs and not URIs.

 $urlClass object  is splitted into following customizable parts via $arrayAccess interface: 
        
 * `PHP_URL_SCHEME` or `'scheme'` - **the scheme component** &laquo;[Wikipedia](https://en.wikipedia.org/wiki/URI_scheme)&raquo;
 * `PHP_URL_HOST` or `'host'` - **a host** component can be either a [Domain name](https://en.wikipedia.org/wiki/Domain_name)
  or an [IP address](http://en.wikipedia.org/wiki/IP_address)
 * `PHP_URL_PORT` or `'port'` - **an optional port** &laquo;[Wikipedia](https://en.wikipedia.org/wiki/Port_(computer_networking))&raquo;
 * `PHP_URL_USER`, `'user'` or `'username'` - **an username**
  &laquo;[Wikipedia](https://en.wikipedia.org/wiki/User_(computing))&raquo;
 * `PHP_URL_PASS`, `'pass'` or `'password'` - **a password**
 * `PHP_URL_PATH` or `'path'` - **path component**
 * `PHP_URL_QUERY` or `'query'` - **query string** &laquo;[Wikipedia](https://en.wikipedia.org/wiki/Query_string)&raquo;
 * `PHP_URL_FRAGMENT` or `'fragment'` - **a fragment identifier** &laquo;[Wikipedia](https://en.wikipedia.org/wiki/Fragment_identifier)&raquo;

MD
);
Manual\visualize('Sphp/Stdlib/Types/URL.php', 'text', false);
