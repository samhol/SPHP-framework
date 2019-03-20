<?php
namespace Sphp\Network;
include '../settings.php';
Headers\Headers::contentType('text/plain');
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Text to send if user hits Cancel button';
    exit;
} else {
    echo "<p>Hello {$_SERVER['PHP_AUTH_USER']}.</p>";
    echo "<p>You entered {$_SERVER['PHP_AUTH_PW']} as your password.</p>";
}
unset($_SERVER['PHP_AUTH_USER']);
//Headers\Headers::setHeader('X-Sample-Test: foo');
echo '<pre>';
var_dump(headers_list ());
echo '</pre>';;

?>
