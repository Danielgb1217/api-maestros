<?php

class Conection
{
   private $server;
   private $user;
   private $password;
   private $database;
   private $port;
   protected $conection;

   function __construct()
   {

      $conectionData = $this->conectionData();
      foreach ($conectionData as $key => $value) {

         $this->server = $value["server"];
         $this->user = $value["user"];
         $this->password = $value["password"];
         $this->database = $value["database"];
         $this->port = $value["port"];
      }

      //Conexion  a la base de datos
      $this->conection = new mysqli($this->server, $this->user, $this->password, $this->database, $this->port);

      if ($this->conection->connect_errno) {
         echo "could not establish connection with the database";
         die();
      }
   }

   private function conectionData()
   {
      $path = dirname(__FILE__);
      $jsonData = file_get_contents($path . "/" . "config");
      return json_decode($jsonData, true);   

   }

   private function convertirUTF8($array)
   {
      array_walk_recursive($array, function (&$item, $key) {

         if (!mb_detect_encoding($item, 'utf-8', true)) {
            $item = utf8_encode($item);
         }
      });
      return $array;
   }

   public function getData($query)
   {
      $response = $this->conection->query($query);
      $responseArray = array();

      foreach ($response as $key) {
         $responseArray[] = $key;    //agregar valores al arreglo uno por uno
      }
      return $this->convertirUTF8($responseArray);
   }


   //Hace un insert
   public function nonQuery($query){
      $resultado = $this->conection->query($query);
      return $this->conection->affected_rows;
   }

//Devuelve el valor del proxumo ID   
   public function nonQueryId($query){
      $result = $this->conection->query($query);
      $filas =  $this->conection->affected_rows;
      if($filas >=1){
         return $this->conection->insert_id;
      }else{
         return 0;
      }
   }

}
