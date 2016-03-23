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

		case 'addPharmacy':
			$qry = mysqli_query(Config::dbConnect(), "INSERT INTO pharmacies (id, name, phoneNumber, location, county ) VALUES ('', '$data->name', '$data->phone', '$data->location', '$data->county');");
			if($qry) print json_encode(1);
			else print json_encode(0);
		break;

		case 'fetchDocs':
			$qry = mysqli_query(Config::dbConnect(), "SELECT * FROM doctors ORDER BY name ASC;");
			$data = array();
			while($row = mysqli_fetch_array($qry)) {
				$data[] = $row;
			}
			print json_encode($data);
		break;
	}
} else {
	print json_encode("no");
}

?>
