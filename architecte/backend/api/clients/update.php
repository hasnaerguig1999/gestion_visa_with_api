<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/clients.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $clients = new clients($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $clients->id = $data->id;

  $clients->nom = $data->nom;
  $clients->prenom = $data->prenom;
  $clients->date_naissance = $data->date_naissance;
  $clients->situation_familiale = $data->situation_familiale;
  $clients->adress = $data->adress;
  $clients->date_depart = $data->fdate_depart;
  $clients->date_darrive = $data->date_darrive;
  $clients->type_pass = $data->type_pass;
  $clients->num_pass= $data->num_pass;
  $clients->nationalite = $data->nationalite;
  $clients->type_visa = $data->type_visa;

  // Update post
  if($clients->update()) {
    echo json_encode(
      array('message' => 'clients Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'clients Not Updated')
    );
  }

