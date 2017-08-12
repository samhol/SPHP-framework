<?php

namespace Sphp\Database;

print_r(Db::query()
                ->from('locations')
                ->get('name', 'country')
                ->groupBy('name ASC')
                ->statementToString());
