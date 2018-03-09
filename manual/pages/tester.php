<?php

namespace Sphp\Html\Attributes;

echo "<pre>";

$attr = new SequenceAttribute('data-foo');
$attr->set("\n  \t\r   ");
$attr->append([' ', ' ']);
echo "\n$attr";
var_dump($attr->toArray());
$attr->set('a b c d e');
$attr->append(['h', 'k']);
echo "\n$attr";
var_dump($attr->toArray());
$attr->clear();
$attr->set(['fuck,     off']);
$attr->set(['fuck,   d44""" off']);
echo "\n$attr";
var_dump($attr->toArray());

namespace Sphp\Html\Head;

$namedContent = [
    'viewport' => 'width=device-width, initial-scale=1',
    'description' => '',
    'author' => '',
    'keywords' => '',
    'robots' => 'index, follow',
    'mobile-web-app-capable' => 'yes',
    'apple-mobile-web-app-capable' => 'yes',
];
foreach ($namedContent as $name => $value) {
  $a = Meta::namedContent($name, $value);
}


use Sphp\Stdlib\Parser;

$d = Parser::fromFile("manual/snippets/meta-data.yaml");
echo "<pre>";
print_r($d);

  $a = Meta::namedContent('e', 'de');
  
  $ba = Meta::namedContent('e', 'e');
$diff =  array_intersect_assoc ($a->metaToArray(), $ba->metaToArray());
if (array_key_exists('name', $diff)) {
  echo 'overrides';
}
print_r(array_intersect_assoc ($a->metaToArray(), $ba->metaToArray()));
echo print_r($d , true);
prArray($d);
echo "</pre>";

  function prArray($array, $path=false, $top=true) {
    $data = "";
    $delimiter = "~~|~~";
    $p = null;
    if(is_array($array)){
      foreach($array as $key => $a){
        if(!is_array($a) || empty($a)){
          if(is_array($a)){
            $data .= $path."['{$key}'] = array();".$delimiter;
          } else {
            $data .= $path."['{$key}'] = \"".htmlentities(addslashes($a))."\";".$delimiter;
          }
        } else {
          $data .= prArray($a, $path."['{$key}']", false);
        }    
      }
    }
    if($top){
      $return = "";
      foreach(explode($delimiter, $data) as $value){
        if(!empty($value)){
          $return .= '$array'.$value."<br>";
        }
      };
      echo $return;
    }
    return $data;
  }
