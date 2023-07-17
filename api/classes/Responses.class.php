<?php

class Responses
{

    public $response = [       

        'status' => 'ok',
        'result' => array()

    ];

    public function error_405()
    {

        $this->response['status'] = 'error';
        $this->response['result'] = array(
            'error_id' => '405',
            'error_msg' => 'Metodo no Permitido'
        );
        return $this->response;
    }

    public function error_200($value = 'Datos Incorrectos')
    {

        $this->response['status'] = 'error';
        $this->response['result'] = array(
            'error_id' => '200',
            'error_msg' => $value
        );
        return $this->response;
    }

    public function error_400()
    {

        $this->response['status'] = 'error';
        $this->response['result'] = array(
            'error_id' => '400',
            'error_msg' => 'Datos Incompletos'
        );
        return $this->response;
    }

    public function error_401($value)
    {

        $this->response['status'] = 'error';
        $this->response['result'] = array(
            'error_id' => '401',
            'error_msg' => $value
        );
        return $this->response;
    }

    
    public function error_500($value = 'Internal Server Error')
    {
        $this->response['status'] = 'error';
        $this->response['result'] = array(
            'error_id' => '500',
            'error_msg' => $value
        );
        return $this->response;
    }



}
