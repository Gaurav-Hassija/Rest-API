<?php
	header('Acess-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: PUT');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


	include_once '../../config/Database.php';
	include_once '../../models/Movie.php';

	$database = new Database();
	$db = $database->connect();

	$movie = new Movie($db);

	//Get the raw posted data

	$data = json_decode(file_get_contents("php://input"));

	$movie->id = $data->id;
	$movie->name = $data->name;
	$movie->language = $data->language;
	$movie->genre = $data->genre;
	$movie->runtime = $data->runtime;
	
	if($movie->update()){
		echo json_encode(array('message' => 'Movie updated'));
	}

	else{
		echo json_encode(array('message' => 'Movie not updated'));
	}

?>