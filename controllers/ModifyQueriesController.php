<?php

class ModifyQueriesController
{
    // url de la pokeapi
    public $name = "https://pokeapi.co/api/v2/pokemon/";
    public function index()
    {
        // se obtienen las queries http://localhost/phpeasy/api.php/pokemons?limit=800&offset=50
        $queries = $_GET;
        $top = isset($queries['limit']) ? $queries['limit'] : 1;
        $pagina = isset($queries['offset']) ? $queries['offset'] : 1;
        // se genera a url con top y skip 
        $url = "https://pokeapi.co/api/v2/pokemon?limit=" . (string) $top . "&offset=" . (string) $pagina;
        // salida o solicitud a la url 
        $salida = file_get_contents($url);
        // se genera la condificación de json a objeto
        $ending = (object) json_decode($salida);

        // se declara un array vacio
        $contenido = [];
        // se recorre todo el objeto y se obtiene su $key $value y modifico la url con mi propia url
        foreach ($ending->results as $key => $value) {
            $contenido[$key] = (object) ["url" => "/phpeasy/views/pokemon.html?pokemon=".$value->name, "name" => $value->name];
        }
        echo json_encode($contenido);
    }

    public function only()
    {
        // obtengo los datos por query
        $queries = $_GET;
        $name = isset($queries['name']) ? $queries['name'] : "ditto";

        // llamo la ruta que esta arriba declarada y luego la concateno con $name
        $url = $this->name . $name;
        $salida = file_get_contents($url);
        $ending = (object) json_decode($salida);
        // declaro 3 arrays vacios 
        $ab = []; $mov = []; $ty = [];

        // limpio los datos que no necesito 
        foreach ($ending->abilities as $key => $value) {
            $ab[$key] = (object) ['id' => $key + 1, 'ability' => $value->ability->name];
        }

        foreach ($ending->moves as $key => $value) {
            $mov[$key] = (object) ['id' => (int) $key + 1, 'move' => $value->move->name];
        }

        foreach ($ending->types as $key => $value) {
            $ty[$key] = (object) ['id' => (int) $key + 1, 'type' => $value->type->name];
        }

        $finalInfo = (object) [
            'id' => $ending->id,
            'name' => $ending->name,
            'sprite' => $ending->sprites->front_default,
            'abilities' => $ab,
            'moves' => $mov,
            'types' => $ty,
        ];

        echo json_encode($finalInfo);
    }
}
