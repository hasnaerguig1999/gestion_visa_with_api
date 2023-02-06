<?php
class clients
{
  // DB stuff
  private $conn;
  private $table = 'clients';

  // Post Properties
  public $id;
  public $nom;
  public $prenom;
  public $date_naissance;
  public $situation_familiale;
  public $adress;
  public $date_depart;
  public $date_darrive;
  public $type_pass;
  public $num_pass;
  public $nationalite;
  public $type_visa;
  public $reff;
  public $CRN;
  public $RDV;

  // Constructor with DB
  public function __construct($db)
  {
    $this->conn = $db;
  }

  //loginAdmin

  public function loginAdmin()
    {
        $query = "SELECT * FROM admin WHERE reff =:reff";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':reff', $this->reff);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
  
  
    //loginClient

  public function loginClient()
    {
        $query = "SELECT * FROM Clients WHERE reff =:reff";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':reff', $this->reff);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

  // Get Posts
  public function read()
  {
    // Create query
    $query = 'SELECT clients.* ,randezvous.id,randezvous.CRN,randezvous.RDV
      FROM clients
      INNER JOIN randezvous
      ON randezvous.reff = clients.reff
      ORDER BY randezvous.id';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Execute query
    $stmt->execute();

    return $stmt;
  }

  // Get Single Post
  public function read_single()
  {
    // Create query

    $query = "SELECT clients.* ,randezvous.id,randezvous.CRN,randezvous.RDV
          FROM clients
          left JOIN randezvous
          ON randezvous.clientId = clients.id WHERE randezvous.id = ? ";

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // // Bind ID
    $stmt->bindParam(1, $this->id);

    // Execute query
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Set properties
    $this->id = $row['id'];
    $this->nom = $row['nom'];
    $this->prenom = $row['prenom'];
    $this->date_naissance = $row['date_naissance'];
    $this->situation_familiale = $row['situation_familiale'];
    $this->adress = $row['adress'];
    $this->date_depart = $row['date_depart'];
    $this->date_darrive = $row['date_darrive'];
    $this->type_pass = $row['type_pass'];
    $this->num_pass = $row['num_pass'];
    $this->nationalite = $row['nationalite'];
    $this->type_visa = $row['type_visa'];
    $this->reff = $row['reff'];
    $this->CRN = $row['CRN'];
    $this->RDV = $row['RDV'];
  }

  // Create Post
  public function create()
  {
    // Create query
    $query = 'INSERT INTO ' . $this->table . ' SET nom =:nom, prenom = :prenom,
    date_naissance = :date_naissance, situation_familiale = :situation_familiale,
      adress= :adress, date_depart = :date_depart, date_darrive = :date_darrive,
       type_pass = :type_pass, num_pass = :num_pass, nationalite = :nationalite,
        type_visa = :type_visa,reff = :reff';
    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->nom = htmlspecialchars(strip_tags($this->nom));
    $this->prenom = htmlspecialchars(strip_tags($this->prenom));
    $this->date_naissance = htmlspecialchars(strip_tags($this->date_naissance));
    $this->situation_familiale = htmlspecialchars(strip_tags($this->situation_familiale));
    $this->adress = htmlspecialchars(strip_tags($this->adress));
    $this->date_depart = htmlspecialchars(strip_tags($this->date_depart));
    $this->date_darrive = htmlspecialchars(strip_tags($this->date_darrive));
    $this->type_pass = htmlspecialchars(strip_tags($this->type_pass));
    $this->num_pass = htmlspecialchars(strip_tags($this->num_pass));
    $this->nationalite = htmlspecialchars(strip_tags($this->nationalite));
    $this->type_visa = htmlspecialchars(strip_tags($this->type_visa));
    $this->reff = htmlspecialchars(strip_tags($this->reff));
    // Bind data
    $stmt->bindParam(':nom', $this->nom);
    $stmt->bindParam(':prenom', $this->prenom);
    $stmt->bindParam(':date_naissance', $this->date_naissance);
    $stmt->bindParam(':situation_familiale', $this->situation_familiale);
    $stmt->bindParam(':adress', $this->adress);
    $stmt->bindParam(':date_depart', $this->date_depart);
    $stmt->bindParam(':date_darrive', $this->date_darrive);
    $stmt->bindParam(':type_pass', $this->type_pass);
    $stmt->bindParam(':num_pass', $this->num_pass);
    $stmt->bindParam(':nationalite', $this->nationalite);
    $stmt->bindParam(':type_visa', $this->type_visa);
    $stmt->bindParam(':reff', $this->reff);
    // Execute query
    if ($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);

    return false;
  }

  // Update Post
  public function update()
  {
    // Create query
    $query = 'UPDATE ' . $this->table .  'SET nom = :nom, prenom = :prenom, date_naissance = :date_naissance,
    situation_familiale = :situation_familiale,  adress= :adress,
     date_depart = :date_depart, date_darrive = :date_darrive, 
     type_pass = :type_pass, num_pass = :num_pass, nationalite = :nationalite, 
     type_visa = :type_visa,reff = :reff
                         WHERE id = :id';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->nom = htmlspecialchars(strip_tags($this->nom));
    $this->prenom = htmlspecialchars(strip_tags($this->prenom));
    $this->date_naissance = htmlspecialchars(strip_tags($this->date_naissance));
    $this->situation_familiale = htmlspecialchars(strip_tags($this->situation_familiale));
    $this->adress = htmlspecialchars(strip_tags($this->adress));
    $this->date_depart = htmlspecialchars(strip_tags($this->date_depart));
    $this->date_darrive = htmlspecialchars(strip_tags($this->date_darrive));
    $this->type_pass = htmlspecialchars(strip_tags($this->type_pass));
    $this->num_pass = htmlspecialchars(strip_tags($this->num_pass));
    $this->nationalite = htmlspecialchars(strip_tags($this->type_visa));
    $this->type_visa = htmlspecialchars(strip_tags($this->type_visa));
    $this->reff = htmlspecialchars(strip_tags($this->reff));
    $this->id = htmlspecialchars(strip_tags($this->id));
    // Bind data
    $stmt->bindParam(':nom', $this->nom);
    $stmt->bindParam(':prenom', $this->prenom);
    $stmt->bindParam(':date_naissance', $this->date_naissance);
    $stmt->bindParam(':situation_familiale', $this->situation_familiale);
    $stmt->bindParam(':adress', $this->adress);
    $stmt->bindParam(':date_depart', $this->date_depart);
    $stmt->bindParam(':date_darrive', $this->date_darrive);
    $stmt->bindParam(':type_pass', $this->type_pass);
    $stmt->bindParam(':num_pass', $this->num_pass);
    $stmt->bindParam(':nationalite', $this->nationalite);
    $stmt->bindParam(':type_visa', $this->type_visa);
    $stmt->bindParam(':reff', $this->reff);
    $stmt->bindParam(':id', $this->id);

    // Execute query
    if ($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);

    return false;
  }

  // Delete Post
  public function delete()
  {

    // Create query
    $query = 'DELETE FROM clients WHERE id = :id ';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->id = htmlspecialchars(strip_tags($this->id));

    // Bind data
    $stmt->bindParam(':id', $this->id);

    // Execute query
    if ($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);

    return false;
  }
}
