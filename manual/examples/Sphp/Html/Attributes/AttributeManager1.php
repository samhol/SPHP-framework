<?php

namespace Sphp\Html\Attributes;

$attrs = new AttributeManager();
$printInput = function($attrs) {
  echo "<input $attrs>\n";
};
/*$attrs->lock("type", "text")
        ->identify("id", "text_", 14);
try {
  $attrs->setId("id", "id");
} catch (\Exception $ex) {
  $attrs->set("value", get_class($ex));
  $printInput();
}*/
echo "vittuuuuu:";
    var_dump(HtmlIdStorage::get()->exists("a", "data-idsca"));
$attrs->set("value", "Sami")
        ->set("disabled", true);
$printInput($attrs);
$attrs->remove("disabled");
$printInput($attrs);
$attrs->set("value", false);
$printInput($attrs);
$attrs->set("placeholder", "First Name");
$printInput($attrs);
$attrs->setId("a", "data-idsca");
?>
