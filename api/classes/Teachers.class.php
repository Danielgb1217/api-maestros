<?php
require_once 'conection/Conection.php';
require_once 'Responses.class.php';

class Teachers extends Conection
{
    private $table = 'maestros';
    private $id = '';
    private $cedula = '';
    private $nombrecompleto = '';
    private $telefono = '';
    private $direccion = '';
    

    //-------------------------------------------METHOD GET---------------------------------------------------------
    public function getTeachers()
    {
        $query = "SELECT id, cedula, nombrecompleto, telefono, direccion FROM " . "pruebatecnica" . '.' . $this->table;
        $data = parent::getData($query);
        return $data;
    }

    //-------------------------------------------METHOD POST---------------------------------------------------------
    public function post($json)
    {
        $response = new Responses;
        $data = json_decode($json, true);    

        $this->cedula = $data['cedula'];
        $this->nombrecompleto = $data['nombrecompleto'];
        $this->telefono = $data['telefono'];
        $this->direccion = $data['direccion'];

        $resp = $this->insertTeacher();

        if ($resp) {
            $response = $response->response;
            $response['result'] = array(
                'id' => $resp
            );
            return $response;
        } else {
            return $response->error_500();
        }
    }

    //-------------------------------Method UPDATE---------------------------------------------------------------

    public function put($json)
    {

        $response = new Responses;
        $data = json_decode($json, true); 

        $this->id = $data['id'];

        if (isset($data['cedula'])) {
            $this->cedula = $data['cedula'];
        }
        if (isset($data['nombrecompleto'])) {
            $this->nombrecompleto = $data['nombrecompleto'];
        }
        if (isset($data['telefono'])) {
            $this->telefono = $data['telefono'];
        }
        if (isset($data['direccion'])) {
            $this->direccion = $data['direccion'];
        }

        $resp = $this->updateTeacher();

        if ($resp) {

            $response = $response->response;
            $response['result'] = array(
                'id' => $resp
            );
            return $response;
        } else {
            return $response->error_500();
        }
    }

    //-------------------------------Method Delete -----------------------------------------------

    public function delete($json)
    {
        $response = new Responses;
        $datos = json_decode($json, true); 

        $this->id = $datos['id'];
        $resp = $this->deleteTeacher();

        if ($resp) {

            $response = $response->response;
            $response['result'] = array(
                'id' => $this->id
            );
            return $response;
        } else {
            return $response->error_500();
        }
    }


    private function insertTeacher()
    {
        // Validar que los campos no estén vacíos
        if (empty($this->cedula) || empty($this->nombrecompleto) || empty($this->telefono) || empty($this->direccion)) {
            return 0; 
        }

        $cedula = $this->conection->real_escape_string($this->cedula);
        $nombrecompleto = $this->conection->real_escape_string($this->nombrecompleto);
        $telefono = $this->conection->real_escape_string($this->telefono);
        $direccion = $this->conection->real_escape_string($this->direccion);

        $query = "INSERT INTO " . "pruebatecnica" . '.' . $this->table . " (cedula, nombrecompleto, telefono, direccion)
            VALUES ('$cedula', '$nombrecompleto', '$telefono', '$direccion')";

        $response = parent::nonQueryId($query);

        return $response; 
    }



    private function updateTeacher()
    {

        $query = "UPDATE " . "pruebatecnica" . '.' . $this->table . " SET cedula = '" . $this->cedula . "', nombrecompleto = '"
            . $this->nombrecompleto . "', telefono = '" . $this->telefono . "', direccion = '" . $this->direccion . "' WHERE id = '" . $this->id . "'";
        // print_r($query);
        $response = parent::nonQuery($query);

        if ($response >= 1) {
            return $response;
        } else {
            return 0;
        }
    }


    private function deleteTeacher()
    {

        $query = "DELETE FROM " . "pruebatecnica" . '.' . $this->table . " WHERE id = '" . $this->id . "'";
        //print_r($query);
        $response = parent::nonQuery($query); //Devuelve las filas afectadas

        if ($response) {
            return $response;
        } else {
            return 0;
        }
    }
}
