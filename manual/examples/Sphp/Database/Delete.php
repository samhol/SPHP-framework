<?php

namespace Sphp\Database;

use Sphp\Database\Rules\Rule;

var_dump(Db::delete()
                ->from('address')
                ->where(Rule::isIn('street', ['Koivuluodontie 2', 'Rakuunatie 59 A 3', 'W2 2UH']))
                ->affectRows());
