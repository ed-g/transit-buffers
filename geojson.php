<?php

// in meters
$buffer_distance = 400;
$root_api_url = 'http://gtfs-api-beta.groth-geodata.com:8374/gtfs-api/';

// array of feed-ids
$feeds = array(
	array("Burbank Bus","burbank-ca-us"),
	array("FlyAway Bus","laxflyaway-ca-us"),
	array("Foothill Transit","foothilltransit-ca-us"),
	array("Glendale Beeline","glendale-ca-us"),
	array("Los Angeles County Metro","lametro-ca-us"),
	array("Metrolink","metrolink-ca-us"),
	array("Palos Verdes Peninsula Transit Authority","pvpta-ca-us"),
	array("Pasadena Area Rapid Transit System","pasadena-ca-us"),
	array("Torrance Transit","torrance-ca-us"),
	array("Big Blue Bus","santamonica-ca-us"),
	array("Culver City Bus","culver-ca-us"),
	array("LADOT DASH and Commuter Express","ladash-ca-us")
	);

// example URL
// http://gtfs-api.groth-geodata.com/gtfs-api-beta/routes/by-feed/anaheim-ca-us/buffer-meters/400

$buffers = array();

foreach ($feeds as &$value) {

$request_url = $root_api_url.'routes/by-feed/'.$value[1].'/buffer-meters/'.$buffer_distance.'/include-stops-buffer';
$api_output = file_get_contents($request_url); 

$properties = array(
'agency-name' => $value[0],
'feed-name' => $value[1]
);

$jsonvar = json_decode($api_output, true);

$geojson = $jsonvar[0]['buffer_geojson'];

$new_array = array(
	'type' => 'Feature',
	'geometry' => $geojson,
	'properties' => $properties);

array_push($buffers, $new_array);

}

$feature_collection = array(
	'type' => 'FeatureCollection',
	'features' => $buffers);

echo json_encode ( $feature_collection);
?>
