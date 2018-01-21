<?php

namespace Sphp\Manual;

codeModal('locations', 'Sphp/Database/locations.sql', "`MySQL` version of locations table")->printHtml();
?>

<input type="radio" name="fname" placeholder="First name"><br>
<input type="range" name="lname" placeholder="Last name"><br>
<form novalidate>
  <?php
  $group = new \Sphp\Html\Foundation\Sites\Forms\Inputs\InputGroup;
//$group->appendInput('number')->setPlaceholder('Age');
  $group->appendInput('text', 'username')->setPlaceholder('insert foo');
  $group->appendInput('email', 'foomail')->setPlaceholder('Type e-mail address');
  $group->appendSubmitter('Submit', 'foo-submit')->addCssClass('success');
  $group->appendResetter('Reset')->addCssClass('alert');
  echo $group;
  ?>
<input id="searchBox" type="text" placeholder="search" />
<script>
   /* Create a configuration object */
   var ss360Config = {
      /* Your site id */
      siteId: 'playground.samiholck.com',
      /* A CSS selector that points to your search  box */
      searchBoxSelector: '#searchBox',     
      searchResultsCaption: 'Found #COUNT# search results for \"#QUERY#\"',
      showImagesSuggestions: false,
      showImagesResults: false,
      minChars: 2,
      themeColor: '#444444',
      suggestionsStyle: {
        text: {
            color: '#444444',
        },
        background: {
            color: '#f0f0f0'
        },
        padding: '10px',
        distanceFromTop: '5px',
        border: {
            color: '#777',
            radius: '3px',
        },
      },
   };
</script>
<script src="https://sitesearch360.com/cdn/sitesearch360-v9.min.js"></script>
