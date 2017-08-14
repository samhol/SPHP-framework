<?php

namespace Sphp\Database;

var_dump(Db::delete()
        ->from('locations')
        ->where(Rule::is('name', 'Hyde Park'))
        ->execute()
        ->rowCount());
