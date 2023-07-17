<?php

require_once 'classes/Responses.class.php';
require_once 'classes/Teachers.class.php';

$response = new Responses;
$teacher = new Teachers;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $getTeachers = $teacher->getTeachers();
    header('Content-type: application/json');
    echo (json_encode($getTeachers));
    http_response_code(200);
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $postBody = file_get_contents('php://input');

    $arrayData = $teacher->post($postBody);
    header('Content-type: application/json');
    if (isset($arrayData['result']['error_id'])) {
        $responseCode = $arrayData['result']['error_id'];
        http_response_code($responseCode);
    } else {
        http_response_code(200);
    }
    echo (json_encode($arrayData));
} else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {

    //recibimos los datos enviados
    $postBody = file_get_contents('php://input');

    $arrayData = $teacher->put($postBody);
    //devolver la rspuesta
    header('Content-type: application/json');
    if (isset($arrayData['result']['error_id'])) {
        $responseCode = $arrayData['result']['error_id'];
        http_response_code($responseCode);
    } else {
        http_response_code(200);
    }
    echo (json_encode($arrayData));
} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

    $header = getallheaders();

    $postBody = file_get_contents('php://input');

    $arrayData = $teacher->delete($postBody);
    //devolver la rspuesta
    header('Content-type: application/json');
    if (isset($arrayData['result']['error_id'])) {
        $responseCode = $arrayData['result']['error_id'];
        http_response_code($responseCode);
    } else {
        http_response_code(200);
    }
    echo (json_encode($arrayData));
} else {
    header('Conten-type: application/json');
    $arrayData = $response->error_405();
    echo json_encode($arrayData);
}
