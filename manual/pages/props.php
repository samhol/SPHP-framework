<?php

echo htmlspecialchars('1,2,3,4', \ENT_COMPAT | \ENT_DISALLOWED | \ENT_HTML5, 'utf-8', false) ;