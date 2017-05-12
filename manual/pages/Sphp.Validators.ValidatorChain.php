<?php

namespace Sphp\Validators;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$validatorInterface = Apis::sami()->classLinker(ValidatorInterface::class);
$validatorAggregate = Apis::sami()->classLinker(ValidatorChain::class);

echo $parsedown->text(<<<MD
##The $validatorAggregate class		
        
The $validatorAggregate is an aggregation of $validatorInterface objects. It 
validates the given input against all of its inner $validatorInterface validators 
and the input is valid only if it passes all of them.
MD
);
CodeExampleBuilder::visualize("Sphp/Validators/ValidatorChain.php", "php", false);
