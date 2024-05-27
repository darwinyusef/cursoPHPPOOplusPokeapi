<?php
class InicioController
{
    public function index()
    {
        // get Queries
        $body = file_get_contents('php://input');
        $datosJson = json_decode($body, true);
        $info = isset($datosJson['info']) ? $datosJson['info'] : '';
        $email = isset($datosJson['email']) ? $datosJson['email'] : '';
        
        //Exceptions  throw new Exception('División por cero..', 500);
        //HTML  echo '<h1>hola a todos</h1>';
        
        // Objects
        $phpObject = (object) [
            "info" => $info,
            "email" => $email,
            'name' => 'foo',
            'age' => 42,
        ];

        // lanzar http status with json
        header('HTTP/1.1 200 OK');
        echo json_encode($phpObject);

        // Redirect
        // header('Location: contacto');
        // exit();
    }
}
