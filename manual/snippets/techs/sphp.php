<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Manual;

include '../../settings.php';
$options = array('options' => array('default' => 'sphp'));
$tech = filter_input(INPUT_GET, 'tech', FILTER_SANITIZE_FULL_SPECIAL_CHARS, $options);
if ($tech === 'sphp') {
  md(<<<MD
        
##SPHPlayground
SPHPlayground is an open source framework for developing interactive web applications and services in object oriented PHP. SPHPlayground can be a part of full stack Web application development.        
        
MD
  );
}

md(<<<MD
HTML5[a] is a markup language used for structuring and presenting content on the World Wide Web. It is the fifth and current major version of the HTML standard.
MD
);
?>
