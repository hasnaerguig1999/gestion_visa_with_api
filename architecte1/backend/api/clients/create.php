<?php
// Headers
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');

// if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
//   if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
//     header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
//   if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
//     header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
// }
// if ($_SERVER["REQUEST_METHOD"] == "OPTIONS") return true;

include_once '../../config/Database.php';
include_once '../../models/clients.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog clients object
$clients = new clients($db);

// Get raw clientsed data
$data = json_decode(file_get_contents("php://input"));

$clients->nom = $data->nom;
$clients->prenom = $data->prenom;
$clients->date_naissance = $data->date_naissance;
$clients->situation_familiale = $data->situation_familiale;
$clients->adress = $data->adress;
$clients->date_depart = $data->date_depart;
$clients->date_darrive = $data->date_darrive;
$clients->type_pass = $data->type_pass;
$clients->num_pass= $data->num_pass;
$clients->nationalite = $data->nationalite;
$clients->type_visa = $data->type_visa;
$clients->reff = $data->reff;




// Create clients
if ($clients->create()) {
  echo json_encode(
    array('message' => 'Client created', 'response' => true)
  );
} else {
  echo json_encode(
    array('message' => 'Client not created', 'response' => false)
  );
}




