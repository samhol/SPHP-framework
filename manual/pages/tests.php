<?php

namespace Sphp\Manual;

use Sphp\Html\Attributes\JsonAttribute;

$json = new JsonAttribute('json', '{ "foo": "bar" }');
$json['foo1'] = 'bar';
echo $json;
$json->set(<<<JSON
        {
    "dots": true,
    "infinite": true,
    "speed": 300,
    "slidesToShow": 4,
    "slidesToScroll": 1,
    "autoplay": true,
    "autoplaySpeed": 2000,
    "responsive": [
      {
        "breakpoint": 1024,
        "settings": {
          "slidesToShow": 3,
          "dots": true
        }
      },
      {
        "breakpoint": 600,
        "settings": {
          "slidesToShow": 2,
          "dots": false
        }
      },
      {
        "breakpoint": 480,
        "settings": {
          "slidesToShow": 1,
          "dots": false
        }
      }
    ]
  }
JSON
);
echo $json;


?>
<?php echo file_get_contents("http://playground.samiholck.com/facebook.svg"); ?>
