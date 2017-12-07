<?php

namespace Sphp\Stdlib\Networks;

use Sphp\Manual;

$urlClass = Manual\api()->classLinker(URL::class);
$parse_url = Manual\php()->functionLink('parse_url');

\Sphp\Manual\md(<<<MD
##URL manipulation with a $urlClass objects

The syntax for an URL string is: `scheme://[user:pass@]domain:port/path?query#fragment`
		
The $urlClass Implements Uniform resource locator (URL) object. 
These Objects allow users to encode, decode, manipulate and compare URLs.

###Object properties
		
The {$urlClass->methodLink('__construct')} parses the input URL string
with $parse_url function and the class $urlClass is therefore 
intended specifically for the  URLs and not URIs.
		
URL string is splitted into following custozable parts in an $urlClass object:

* `scheme` e.g. file, http, https,... &laquo;<a href="http://en.wikipedia.org/wiki/URI_scheme" target="_blank">Wikipedia</a>&raquo;
* `user` The username field
* `pass` The password field
* `host` can be one of the following types:
	* &laquo;<a href="http://en.wikipedia.org/wiki/Domain_name" target="_blank">Domain name</a>&raquo;
	* &laquo;<a href="http://en.wikipedia.org/wiki/IP_address" target="_blank">IP address</a>&raquo;
* `path` &laquo;<a href="http://en.wikipedia.org/wiki/Path_(computing)" target="_blank">Wikipedia</a>&raquo;
* `port` &laquo;<a href="http://en.wikipedia.org/wiki/Port_(computer_networking)" target="_blank">Wikipedia</a>&raquo;
* `query` &laquo;<a href="http://en.wikipedia.org/wiki/Query_string" target="_blank">Wikipedia</a>&raquo;
	* The `query` string contains data to be passed to software running on the server.
* `fragment` &laquo;<a href="http://en.wikipedia.org/wiki/Fragment_identifier" target="_blank">Wikipedia</a>&raquo;
	* **IMPORTANT:** the browser won't send a request with a `fragment` part. 
	  The `fragment` part of the URL is resolved right there in the browser.
		
MD
);
Manual\visualize('Sphp/Stdlib/Types/URL.php', 'text', false);
