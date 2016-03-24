<?php
include "config.php";
header('Content-Type : application/json');
$qry = mysqli_query(Config::dbConnect(), "SELECT pharmacies.id, pharmacies.name, pharmacies.phoneNumber, pharmacies.location, counties.name as county FROM pharmacies INNER JOIN counties ON counties.id = pharmacies.county ORDER BY counties.name ASC;");
$data = array();
while($row = mysqli_fetch_assoc($qry)) {
  $data[] = $row;
}
$data = array("pharmacies" => $data);
print json_encode($data);
 ?>
