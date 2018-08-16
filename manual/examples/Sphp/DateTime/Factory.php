<?php

namespace Sphp\DateTime;

var_dump(Intervals::create('3:02:11')->format('%h hours %i minutes and %s seconds'),
        Intervals::create('-2 days 6 hours')->format('%d days %h hours %i minutes and %s seconds'),
       Intervals::create('PT5H15M10S')->format('%h hours %i minutes and %s seconds'));
