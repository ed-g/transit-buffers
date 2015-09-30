<?php

// in meters
$buffer_distance = 400;
$root_api_url = 'http://gtfs-api.groth-geodata.com/gtfs-api-beta/';

// array of feed-ids
$feeds = array(
	array("Burbank Bus","burbank-ca-us"),
	array("FlyAway Bus","laxflyaway-ca-us"),
//	array("Foothill Transit","foothilltransit-ca-us"),
//	array("Glendale Beeline","glendale-ca-us"),
//	array("Los Angeles County Metro","lametro-ca-us"),
//	array("Metrolink","metrolink-ca-us"),
	array("Palos Verdes Peninsula Transit Authority","pvpta-ca-us"),
//	array("Pasadena Area Rapid Transit System","pasadena-ca-us"),
//	array("Torrance Transit","torrance-ca-us"),
//	array("Big Blue Bus","santamonica-ca-us"),
//	array("Culver City Bus","culver-ca-us"),
//	array("LADOT DASH and Commuter Express","ladash-ca-us")
	);

// http://gtfs-api.groth-geodata.com/gtfs-api-beta/routes/by-feed/anaheim-ca-us/buffer-meters/400


$api_output = file_get_contents('http://gtfs-api.ed-groth.com/gtfs-api/routes/by-feed/eldoradotransit-ca-us'); 

header('Content-Type: application/json');

$jsonvar = json_decode($api_output, true);

$route_alignments = Array();

foreach ($jsonvar as &$value) {

$properties = array(
'name' => $value['route_short_name'],
'route_short_name' => $value['route_short_name'],
'route_long_name' => $value['route_long_name'],
'route_id' => $value['route_id'],
'route_id' => $value['route_id'],
'agency_id' => $value['agency_id'],
'route_color' => $value['route_color']);

if (is_null($value['shared_arcs_geojson'])) 
	{$geojson = $value['simple_00004_geojson'];}
else {$geojson = $value['shared_arcs_geojson'];}


$geojson = 

$new_array = array(
	'type' => 'Feature',
	'geometry' => $geojson,
	'properties' => $properties);

array_push($route_alignments, $new_array);

}

$feature_collection = array(
	'type' => 'FeatureCollection',
	'features' => $route_alignments);

echo json_encode ( $feature_collection);

?>