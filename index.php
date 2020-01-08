<?php
  class Configurazione {

    public $id;
    public $title;
    public $description;

    function __construct($id , $title , $description) {

      $this -> id = $id;
      $this -> title = $title;
      $this -> description = $description;
    }

    //funzioni utili

    public function __toString() {

      return "[" . $this -> id  . "]" . 
              " - " . $this -> title .
              " - " . $this -> description . "<br>" ;
    }
  }

// connessione al DB

  $server = "localhost";
  $username = "root";
  $password = "root";
  $dbname = "HotelDB";

  $conn = new mysqli($server, $username, $password, $dbname);
  if ($conn -> connect_errno) {

    echo json_encode(-1);
    return;
  }


// download di tutte le configurazioni

  $sql = "

      SELECT *
      FROM configurazioni

  ";
  $res = $conn -> query($sql);
  if ($res -> num_rows < 1) {

    echo json_encode(-2);
    return;
  }

  $confs = [];
  while($conf = $res -> fetch_assoc()) {
    $confs[] = new Configurazione($conf['id'],
                                  $conf['title'],
                                  $conf['description']);
  }
  $conn -> close();
  foreach ($confs as $conf) {
    echo $conf;
  }