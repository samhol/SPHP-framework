<?php

use Sphp\Stdlib\Reader\Yaml;

$data = (new Yaml())->fromFile('manual/yaml/document_data.yml');

  //print_r($data);

  $groups = new \Sphp\Manual\MVC\TagListing\Groups($data);

  //echo "<pre>";
  //print_r($groups);
  /*foreach ($groups as $group) {
    echo $group->getName();
    //echo new Sphp\Manual\MVC\TagListing\TagGroupTable($group);
  }*/
  echo new Sphp\Manual\MVC\TagListing\TagListAccordionGenerator($groups);
  //echo "</pre>";

  
