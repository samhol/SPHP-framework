<?php

namespace Sphp\DateTime;

var_dump(Factory::dateInterval('3:02:11')->format('%h hours %i minutes and %s seconds'),
        Factory::dateInterval('-2 days 6 hours')->format('%d days %h hours %i minutes and %s seconds'),
       Factory::dateInterval('PT5H15M10S')->format('%h hours %i minutes and %s seconds'));
