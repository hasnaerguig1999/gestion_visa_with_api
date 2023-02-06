<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/clients.php';

  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog clients object
  $clients = new clients($db);

  // Get ID
  $clients->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get clients
  $clients->read_single();

 
  // Create array
  $clients_arr = array(
      'id' => $clients->id,
      'nom' =>$clients->nom,
      'prenom' => $clients->prenom,
      'date_naissance' => $clients->date_naissance,
      'situation_familiale' => $clients->situation_familiale,
      'adress' => $clients->adress,
      'date_depart' => $clients->date_depart,
      'date_darrive' => $clients->date_darrive,
      'type_pass' => $clients->type_pass,
      'num_pass' => $clients->num_pass,
      'nationalite' => $clients->nationalite,
      'type_visa' => $clients->type_visa,
      'reff' => $clients->reff,
      'CRN' => $clients->CRN,
      'RDV' => $clients->RDV
  );

  // Make JSON
  print_r(json_encode($clients_arr));