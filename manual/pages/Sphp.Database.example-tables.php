<?php

namespace Sphp\Manual;

$locationsSQL = codeModal('locations', 'Sphp/Database/locations.sql', 'Example tables as MySQL');
$addressSQL = codeModal('address', 'Sphp/Database/address.sql', 'Example tables as MySQL');
$personsSQL = codeModal('persons', 'Sphp/Database/person.sql', 'Example tables as MySQL');

md(<<<MD

__SQL table creation codes for example tables:__
        
 * Example code for $locationsSQL table
 * Example code for $addressSQL table
 * Example code for $personsSQL table

MD
);
