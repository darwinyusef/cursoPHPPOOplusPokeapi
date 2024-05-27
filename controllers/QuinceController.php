<?php

class QuinceController
{ 
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $salida = file_get_contents("https://jsonplaceholder.typicode.com/todos");
            $ending = json_decode($salida);
            echo json_encode($ending);
        } else {
            //echo json_encode((object) ["ms" => "esta funcion solo corre atraves de POST", 'response' => false]);
            throw new Exception('Debe solicitar este servicio por POST', 400);
        }
    }

    public function piedraPepito($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $tamanio = 'pequenio';
            $status = "Se asusta";
            if ($id == "die") {
                $tamanio = 'grande';
                $status = "Se muere y llega el CTI";
            }
            $history = (object) [
                "tamanio" => $tamanio,
                "status" => $status
            ];

            echo json_encode($history);
        } else {
            throw new Exception('Debe solicitar este servicio por POST', 400);
        }
    }
}
