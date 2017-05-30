<?php

namespace Sphp\Db;

use Sphp\Objects\User as User;

$query = (new Query());
$query->from("users")
        ->get("fname", "lname", "email", "streetaddress", "zipcode", "city", "country")
        ->orderBy("lname ASC", "fname ASC")
        ->limit(15);
//echo $query . "\n";
$result = $query->fetchArray();
/**
 * @var User[]
 */
$users = [];
foreach ($query as $row) {
  $users[] = (new User())->from($row);
}
//var_dump($result);
//echo "Result: " . $result[];

namespace Sphp\Html\Tables;

$table = new Table();
$table->thead()->append(["Username", "First name", "last name", "street address", "zipcode", "city", "country"]);
$tbody = $table->tbody();
foreach ($users as $row => $user) {
  $tds[] = $user->getFname();
  $tds[] = $user->getLname();
  $tbody->append($tds);
}
$table->printHtml();
?>