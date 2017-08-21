<?php

namespace Sphp\Db;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;
$sqlException = Apis::sami()->classLinker(SQLException::class);
$pdo = Apis::phpManual()->classLinker(\PDO::class);
$ns = Apis::sami()->namespaceBreadGrumbs(__NAMESPACE__);
\Sphp\Manual\parseDown(<<<MD
#DATABASE MANIPULATION: 
$ns
The PHP Data Objects $pdo extension defines a lightweight, consistent interface
for accessing databases in PHP. In SPHP framework the $pdo extension is wrapped
into maybe more intuitive group of classes.

In all of the classes if any constraints are violated, the current database
operation is canceled and an $sqlException is returned instead.

Example database applicatíon:
MD
);
$usersTableSql = (new CodeExampleBuilder('Sphp/Db/create_session_user.sql'))
		->setExamplePaneTitle("SQL code of the 'users' table")
		->printHtml();
CodeExampleBuilder::visualize('Sphp/Db/dbObjectsView.php', 1, 'text');
CodeExampleBuilder::visualize('Sphp/Db/usersAsHtmlTable.php', 2);

\Sphp\Manual\loadPage('Sphp.Db.Db');
\Sphp\Manual\loadPage('Sphp.Db.Query');
\Sphp\Manual\loadPage('Sphp.Db.Insert');
\Sphp\Manual\loadPage('Sphp.Db.Update');
\Sphp\Manual\loadPage('Sphp.Db.Delete');
