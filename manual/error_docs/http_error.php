<?php

namespace Sphp\Html;

$http_status_codes = [
    400 => 'Client Error: Bad Request',
    401 => 'Client Error: Unauthorized',
    402 => 'Client Error: Payment Required',
    403 => 'Client Error: Forbidden',
    404 => 'Client Error: Not Found',
    405 => 'Client Error: Method Not Allowed',
    406 => 'Client Error: Not Acceptable',
    407 => 'Client Error: Proxy Authentication Required',
    408 => 'Client Error: Request Timeout',
    409 => 'Client Error: Conflict',
    410 => 'Client Error: Gone',
    411 => 'Client Error: Length Required',
    412 => 'Client Error: Precondition Failed',
    413 => 'Client Error: Request Entity Too Large',
    414 => 'Client Error: Request-URI Too Long',
    415 => 'Client Error: Unsupported Media Type',
    416 => 'Client Error: Requested Range Not Satisfiable',
    417 => 'Client Error: Expectation Failed',
    418 => 'Client Error: I\'m a teapot',
    419 => 'Client Error: Authentication Timeout',
    420 => 'Client Error: Method Failure',
    422 => 'Client Error: Unprocessable Entity',
    423 => 'Client Error: Locked',
    424 => 'Client Error: Method Failure',
    425 => 'Client Error: Unordered Collection',
    426 => 'Client Error: Upgrade Required',
    428 => 'Client Error: Precondition Required',
    429 => 'Client Error: Too Many Requests',
    431 => 'Client Error: Request Header Fields Too Large',
    444 => 'Client Error: No Response',
    449 => 'Client Error: Retry With',
    450 => 'Client Error: Blocked by Windows Parental Controls',
    451 => 'Client Error: Redirect',
    494 => 'Client Error: Request Header Too Large',
    495 => 'Client Error: Cert Error',
    496 => 'Client Error: No Cert',
    497 => 'Client Error: HTTP to HTTPS',
    499 => 'Client Error: Client Closed Request',
    500 => 'Server Error: Internal Server Error',
    501 => 'Server Error: Not Implemented',
    502 => 'Server Error: Bad Gateway',
    503 => 'Server Error: Service Unavailable',
    504 => 'Server Error: Gateway Timeout',
    505 => 'Server Error: HTTP Version Not Supported',
    506 => 'Server Error: Variant Also Negotiates',
    507 => 'Server Error: Insufficient Storage',
    508 => 'Server Error: Loop Detected',
    509 => 'Server Error: Bandwidth Limit Exceeded',
    510 => 'Server Error: Not Extended',
    511 => 'Server Error: Network Authentication Required',
    598 => 'Server Error: Network read timeout error',
    599 => 'Server Error: Network connect timeout error',
];

require_once '../settings.php';

//require_once('../htmlHead.php');
$doc = Document::html('manual');
//echo $doc->body()->getOpeningTag();
$code = filter_input(INPUT_GET, 'error', FILTER_SANITIZE_NUMBER_INT);
header("HTTP/1.0 420 Not Found");
//var_dump(http_response_code(406));
//echo "#$code";
$doc->enableSPHP();
$doc->body()->addCssClass('error-doc');

use Sphp\Html\Foundation\Sites\Grids\Grid;

$grid = new Grid();
$row = new Foundation\Sites\Grids\Row();
        $row->appendColumn(null, 10, 8, 6, 4);
$col->appendMd(<<<TEXT
#$code
TEXT
);
$doc->append($grid->append($col));
if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
  $refuri = parse_url($_SERVER['HTTP_REFERER']); // use the parse_url() function to create an array containing information about the domain
  $doc->append($_SERVER['HTTP_REFERER']);
  if ($refuri['host'] == "cutlery-in-the-toaster.com") {
    echo "You should email fork@cutlery-in-the-toaster.com and tell me I have a dead link on this site.";
  } else {
    echo "You should email someone over at " . $refuri['host'] . " and let them know they have a dead link to this site.";
  }
} else {
  echo "If you got here from Angola, you took a wrong turn at Catumbela. And if you got here by typing randomly in the address bar, stop doing that. You're filling my error logs with unnecessary junk.";
}
if (array_key_exists($code, $http_status_codes)) {
  //echo $http_status_codes[$code];
  $doc->setDocumentTitle($code . ": " . $http_status_codes[$code]);
}
echo $doc;
?>


<!--
   - Unfortunately, Microsoft has added a clever new
   - "feature" to Internet Explorer. If the text of
   - an error's message is "too small", specifically
   - less than 512 bytes, Internet Explorer returns
   - its own error message. You can turn that off,
   - but it's pretty tricky to find switch called
   - "smart error messages". That means, of course,
   - that short error messages are censored by default.
   - IIS always returns error messages that are long
   - enough to make Internet Explorer happy. The
   - workaround is pretty simple: pad the error
   - message with a big comment like this to push it
   - over the five hundred and twelve bytes minimum.
   - Of course, that's exactly what you're reading
   - right now.
-->
