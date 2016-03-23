<?php
$data = json_decode(file_get_contents("php://input"));

if (isset($data->req)) {
	include "config.php";

	switch($data->req) {
		case 'addHospital':
			$qry = mysqli_query(Config::dbConnect(), "INSERT INTO hospitals (id, name, county, location) VALUES ('', '$data->hospitalName', '$data->county', '$data->hospitalLocation');");
			if($qry) print json_encode(1);
			else print json_encode(0);
		break;
	}
} else {
	print json_encode("no");
}

?>
