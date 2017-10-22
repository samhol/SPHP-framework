<?php
namespace Sphp\Html\Attributes\Utils;

$s = new UtilityStrategy();
echo "<pre>";
var_dump($s->getUtilityFor('class'));
var_dump($s->getUtilityFor('class'));
var_dump($s->getUtilityFor('class'));
var_dump($s->getUtilityFor('class'));
var_dump($s->getUtilityFor('style'));
var_dump($s->getUtilityFor('style'));
var_dump($s->getUtilityFor('style'));
var_dump($s->getUtilityFor('style'));
namespace Zend\Di;
$di = new Di();
$movieLister = $di->get(\Sphp\Html\Attributes\MultiValueAttribute::class, ['name' => 'foo']);
echo $movieLister->set('u');;

namespace Sphp\Html\Attributes;
$ag = new AttributeGenerator();
//use Sphp\Stdlib\Reader\Yaml;

//$data = (new Yaml())->fromFile('manual/yaml/document_data.yml');

  //print_r($data);

//  $groups = new \Sphp\Manual\MVC\TagListing\Groups($data);

  //echo "<pre>";
  //print_r($groups);
  /*foreach ($groups as $group) {
    echo $group->getName();
    //echo new Sphp\Manual\MVC\TagListing\TagGroupTable($group);
  }*/
//  echo new Sphp\Manual\MVC\TagListing\TagListAccordionGenerator($groups);
  //echo "</pre>";

  
