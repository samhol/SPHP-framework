<?php

namespace Sphp\Validators;

use Sphp\Manual;

$patrnvLink = Manual\api()->classLinker(PatternValidator::class);

Manual\parseDown(<<<MD
##The $patrnvLink class		
  
The $patrnvLink validates the input against the given regular expression. The input
is valid if it matches the given pattern. 
MD
);

Manual\visualize('Sphp/Validators/PatternValidator.php', 'php', false);
