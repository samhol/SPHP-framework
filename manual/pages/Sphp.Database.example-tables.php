<?php

namespace Sphp\Manual;

$locationsSQL = codeModal('locations', 'Sphp/Database/locations.sql', 'Example tables as MySQL');
$addressSQL = codeModal('address', 'Sphp/Database/address.sql', 'Example tables as MySQL');
$personsSQL = codeModal('persons', 'Sphp/Database/person.sql', 'Example tables as MySQL');

md(<<<MD

__SQL table creation codes for example tables:__
<ol>
<li>Example code for $locationsSQL table</li>
<li>Example code for $addressSQL table</li>
<li>Example code for $personsSQL table</li>
</ol>
MD
);
