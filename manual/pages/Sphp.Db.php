<?php

namespace Sphp\Db;

use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;
use Sphp\Html\Apps\Manual\Apis;
$sqlException = Apis::apigen()->classLinker(SQLException::class);
$pdo = Apis::phpManual()->classLinker(\PDO::class);
$ns = Apis::apigen()->namespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
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
$usersTableSql = (new CodeExampleAccordion())
		->fromFile(EXAMPLE_DIR . "Sphp/Db/create_session_user.sql")
		->setExampleHeading("SQL code of the 'users' table")
		->printHtml();
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Db/dbObjectsView.php", 1, "text");
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Db/usersAsHtmlTable.php", 2);

$load("Sphp.Db.Db.php");
$load("Sphp.Db.Query.php");
$load("Sphp.Db.Insert.php");
$load("Sphp.Db.Update.php");
$load("Sphp.Db.Delete.php");
