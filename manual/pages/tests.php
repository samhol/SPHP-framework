<?php

namespace Sphp\Manual;
var_dump (new \stdClass() == 2);
md(<<<MD
```ini
[XDebug]
zend_extension = "c:\xampp\php\ext\php_xdebug-2.5.5-7.1-vc14.dll"
xdebug.remote_autostart = 1
xdebug.profiler_append = 0
xdebug.profiler_enable = 0
xdebug.profiler_enable_trigger = 0
xdebug.profiler_output_dir = "c:\xampp\tmp"
;xdebug.profiler_output_name = "cachegrind.out.%t-%s"
xdebug.remote_enable = 1
xdebug.remote_handler = "dbgp"
xdebug.remote_host = "127.0.0.1"
xdebug.remote_log="c:\xampp\tmp\xdebug.txt"
xdebug.remote_port = 9000
xdebug.trace_output_dir = "c:\xampp\tmp"
; 3600 (1 hour), 36000 = 10h
xdebug.remote_cookie_expire_time = 36000
```
        
gerg
MD
);


codeModal('locations', 'Sphp/Database/locations.sql', "`MySQL` version of locations table")->printHtml();
?>
<div class="expanded small alert button-group">
  <a class="button alert">Harder</a>
  <a class="button success">Better</a>
  <a class="button">Faster</a>
  <a class="button">Stronger</a>
</div>

<?php


md(<<<MD

```
zend_extension = "c:\xampp\php\ext\php_xdebug-2.5.5-7.1-vc14.dll"
xdebug.remote_autostart = 1
xdebug.profiler_append = 0
xdebug.profiler_enable = 0
xdebug.profiler_enable_trigger = 0
xdebug.profiler_output_dir = "c:\xampp\tmp"
;xdebug.profiler_output_name = "cachegrind.out.%t-%s"
xdebug.remote_enable = 1
xdebug.remote_handler = "dbgp"
xdebug.remote_host = "127.0.0.1"
xdebug.remote_log="c:\xampp\tmp\xdebug.txt"
xdebug.remote_port = 9000
xdebug.trace_output_dir = "c:\xampp\tmp"
; 3600 (1 hour), 36000 = 10h
xdebug.remote_cookie_expire_time = 36000
```
        
gerg
MD
);
