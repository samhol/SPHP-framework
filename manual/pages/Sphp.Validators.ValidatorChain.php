<?php

namespace Sphp\Validators;

$validator = \Sphp\Manual\api()->classLinker(Validator::class);
$validatorAggregate = \Sphp\Manual\api()->classLinker(ValidatorChain::class);

\Sphp\Manual\md(<<<MD
##The $validatorAggregate class		
        
The $validatorAggregate is an aggregation of $validator objects. It 
validates the given input against all of its inner validators 
and the input is valid only if it passes all of them.
MD
);
\Sphp\Manual\visualize('Sphp/Validators/ValidatorChain.php', 'php', false);
